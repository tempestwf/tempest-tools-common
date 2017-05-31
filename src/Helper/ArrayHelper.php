<?php

namespace TempestTools\Common\Helper;

use ArrayObject;
use TempestTools\Common\Utility\ErrorConstantsTrait;

class ArrayHelper
{
    use ErrorConstantsTrait;

    /**
     * @var array ERRORS
     * A constant that stores the errors that can be returned by the class
     */
    const ERRORS = [
        'stringPathDoesNotStartWith'=>
            [
                'message'=>'Error: string passed to parseStringPath does not start with path separator',
            ],
        'noExtendsKeyInArray'=>
            [
                'message'=>'Error: array passed to parseInheritancePath does not have an "extends" key',
            ],
    ];

    /**
     * The source array used by other methods of the class
     * @var ArrayObject $array
     */
    protected $array;

    /**
     * A character used to separate paths in the array when stored in a string
     * @var string PATH_SEPARATOR
     */
    const PATH_SEPARATOR = ':';

    /**
     * The start of a placeholder
     * @var string START_PLACEHOLDER
     */
    const START_PLACEHOLDER = '{{';
    /**
     * The end of a placeholder
     * @var string END_PLACEHOLDER
     */
    const END_PLACEHOLDER = '}}';
    /**
     * Regex used to extract values from placeholders
     * @var string PLACEHOLDER_REGEX
     */
    const PLACEHOLDER_REGEX = '/[^{}]+(?=\}\})/';
    /**
     * The key of an array element that used to let the source array inherit values from the array set on the helper class
     * @var string EXTENDS_KEY
     */
    const EXTENDS_KEY = 'extends';


    public function parseInheritance(array $source):array{
        $array = $this->getArray();

        $extends = $this->parseInheritancePath($source);
    }

    public function parseInheritancePath(array $source){
        if (!isset($source[static::EXTENDS_KEY])) {
            throw new \RuntimeException(_($this->getErrorFromConstant('noExtendsKeyInArray')['message']));
        }


        /*$extends = $source[static::EXTENDS_KEY];
        for($n=0;$n<count($extends)){

        }*/

    }

    /**
     * Replaces placeholder values wrapped in {{}} with the paths stored inside them.
     * For instance
     * {{:key1:subKey1:subKey2}} would return "foo" from array:
     * [
     *  'key1' => [
     *      'subKey1' => [
     *          'subKey2' => 'foo'
     *      ]
     *  ]
     * ]
     *
     * @param string $template
     * @return string
     * @throws \RuntimeException
     */
    public function parseTemplate(string $template):string{
        preg_match_all(static::PLACEHOLDER_REGEX, $template, $matches);
        $replacements =  [];
        $patterns = [];
        /** @var array $matches */
        foreach($matches as $match) {
            $patterns[] = static::START_PLACEHOLDER . $match . static::END_PLACEHOLDER;
            $replacements[] = $this->parseStringPath($match);
        }
        return preg_replace($patterns, $replacements, $template);
    }


    /**
     * Gets an value from the array, using a : separated list of array keys passed in as a string. For instance
     * :key1:subKey1:subKey2 would return "foo" from array:
     * [
     *  'key1' => [
     *      'subKey1' => [
     *          'subKey2' => 'foo'
     *      ]
     *  ]
     * ]
     *
     * @param string $path
     * @throws \RuntimeException
     * @returns ArrayObject|mixed
     */
    public function parseStringPath(string $path) {
        if ($path[0] !== static::PATH_SEPARATOR) {
            throw new \RuntimeException(_($this->getErrorFromConstant('stringPathDoesNotStartWith')['message']));
        }
        $path = ltrim($path, static::PATH_SEPARATOR);
        $pathArray =  preg_split('/' . static::PATH_SEPARATOR . '/', $path);
        return $this->parseArrayPath($pathArray);
    }

    /**
     * Gets an value from the array, using a array keys passed. For instance ['key1','subKey1','subKey2'] would return
     * "foo" from array:
     * [
     *  'key1' => [
     *      'subKey1' => [
     *          'subKey2' => 'foo'
     *      ]
     *  ]
     * ]
     *
     * @param array $path
     * @return ArrayObject|mixed
     */
    public function parseArrayPath(array $path) {
        $result = $this->getArray();
        foreach ($path as $pathPiece) {
            $result = $result[$pathPiece];
        }
        return $result;
    }

    /**
     * @param ArrayObject $array
     * @return ArrayHelper
     */
    public function setArray(ArrayObject $array): ArrayHelper
    {

        $this->array = $array;
        return $this;
    }

    /**
     * @return ArrayObject
     */
    public function getArray(): ArrayObject
    {
        return $this->array;
    }


}
