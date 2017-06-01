<?php

namespace TempestTools\Common\Helper;

use ArrayObject;
use Closure;
use TempestTools\Common\Contracts\Extractable;
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
        'circularInheritanceDetected'=>
            [
                'message'=>'Error: Circular inheritance detected in array',
            ],
        'notExtractable'=>
            [
                'message'=>'Error: object passed to extract method does not implement the Extractable interface',
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
    /**
     * The key used to list the path that was extended
     * @var string EXTENDED_KEY
     */
    const EXTENDED_KEY = 'extended';
    /**
     * The character to put at the beginning of a string to trigger automatic parsing.
     * @var string TRIGGER_STRING_PARSE
     */
    const TRIGGER_STRING_PARSE = '?';

    /**
     * Takes an array of objects, and tries to call extractValues on each one, it then stores the result on the objects stored array.
     *
     * @param array $objects
     * @return ArrayObject
     * @throws \RuntimeException
     */
    public function extract(array $objects):ArrayObject {
        $array = $this->getArray();
        $array = $array ?? new ArrayObject();
        foreach ($objects as $object) {
            if (!$object instanceof Extractable) {
                throw new \RuntimeException($this->getErrorFromConstant('noExtendsKeyInArray')['message']);
            }
            $extracted = $object->extractValues();
            foreach ($extracted as  $key => $value){
                $array[$key] = $value;
            }
        }
        return $array;
    }

    /**
     * Automatically detects what operations should be run on a value and then runs them.
     * Remember to put ? at the strong of any string you want to be automatically handled by this method.
     *
     * @param $value
     * @return array|ArrayObject|mixed|string
     * @throws \RuntimeException
     */
    public function parse($value){
        if ($value instanceof Closure) {
            return $this->parseClosure($value);
        }

        if (is_array($value)) {
         return $this->parseInheritance($value);
        }

        if (is_string($value) && $value[0] === static::TRIGGER_STRING_PARSE) {
            $value = $this->trimFront($value);
            if ($value[0] === static::PATH_SEPARATOR) {
                return $this->parseStringPath($value);
            }

            return $this->parseTemplate($value);
        }

        return $value;

    }

    /**
     * Parses a closure and passes it $this
     * @param Closure $closure
     * @return mixed
     */
    public function parseClosure(Closure $closure) {
        return $closure($this);
    }

    /**
     * Looks at an array that has an "extends" key.
     * It calculates the full inheritance path by following the extends path set on the source that was passed,
     * that leads through the extends paths stored on the array attached to this class.
     * Once it has the full path of extends calculated, it starts using array_replace to apply the values from the parts of the array referenced in the extends path.
     * It then removes the extends property from the source array and puts in instead a: extended property that lists the path that was used for extension.
     *
     * @param array $source
     * @return array
     * @throws \RuntimeException
     */
    public function parseInheritance(array $source):array{
        $extends = $this->parseInheritancePath($source);
        $origExtends = $extends;

        while (count($extends)>0) {
            $extend = array_pop($extends);
            $target = $this->parseStringPath($extend);
            array_replace($source, $target);
        }
        $source[static::EXTENDED_KEY] = $origExtends;
        unset($source[static::EXTENDS_KEY]);
        return $source;
    }

    /**
     * Created the extends path used by parseInheritance. See that method for more details.
     * Example:
     * With an array like so:
     * *[
     *  'base'=> [
     *	'extends'=>[]
     *  ],
     *  'one'=> [
     *    'extends'=>[':base']
     *  ],
     *  'two'=> [
     *    'extends'=>[':one']
     *  ],
     *  'three'=> [
     *    'extends'=>[':two', ':four']
     *  ],
     *  'four'=> [
     *	'extends'=>[]
     *  ]
     *]
     * If you pass this method a source like so:
     * [
     *    'extends'=>['two', 'four']
     *  ]
     * You would get a result of:
     * ["two", "one", "base", "four"]
     * @param array $source
     * @return array
     * @throws \RuntimeException
     */
    public function parseInheritancePath(array $source):array{
        if (!isset($source[static::EXTENDS_KEY])) {
            throw new \RuntimeException($this->getErrorFromConstant('noExtendsKeyInArray')['message']);
        }

        /** @var array $extendsList */
        $extendsList = $source[static::EXTENDS_KEY];

        /** @noinspection CallableInLoopTerminationConditionInspection */
        for($n=0; $n<count($extendsList); $n++) {
            $extends = $extendsList[$n];
            $target = $this->parseStringPath($extends);
            if (isset($target[static::EXTENDS_KEY]) && is_array($target[static::EXTENDS_KEY]) && count($target[static::EXTENDS_KEY]) > 0) {
                $targetExtends = $target[static::EXTENDS_KEY];
                array_splice($extendsList,$n+1,0,$targetExtends);
                if (count($extendsList) !== count(array_count_values($extendsList))) {
                    throw new \RuntimeException($this->getErrorFromConstant('circularInheritanceDetected')['message']);
                }
            }
        }

        return $extendsList;
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
        $template = $this->trimFront($template);
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
     * @returns mixed
     */
    public function parseStringPath(string $path) {
        $path = $this->trimFront($path);
        if ($path[0] !== static::PATH_SEPARATOR) {
            throw new \RuntimeException($this->getErrorFromConstant('stringPathDoesNotStartWith')['message']);
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
     * @return mixed
     */
    public function parseArrayPath(array $path) {
        $result = $this->getArray();
        foreach ($path as $pathPiece) {
            $result = $result[$pathPiece];
        }
        return $result;
    }

    /**
     * Trims the ? from the front of a a string
     * @param string $value
     * @return string
     */
    protected function trimFront(string $value):string {
        return ltrim($value, static::TRIGGER_STRING_PARSE);
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
