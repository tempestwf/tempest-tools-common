<?php

namespace TempestTools\Common\Helper;

use ArrayObject;
use Closure;
use TempestTools\Common\Contracts\Extractable;
use TempestTools\Common\Utility\ErrorConstantsTrait;

class ArrayHelper implements \TempestTools\Common\Contracts\ArrayHelper
{
    use ErrorConstantsTrait;

    /**
     * @var array ERRORS
     * A constant that stores the errors that can be returned by the class
     */
    const ERRORS = [
        'stringPathDoesNotStartWith'=>
            [
                'message'=>'Error: string passed to parseStringPath does not start with path separator. path= %s.',
            ],
        'circularInheritanceDetected'=>
            [
                'message'=>'Error: Circular inheritance detected in array. extends = %s.',
            ],
        'notExtractable'=>
            [
                'message'=>'Error: object passed to extract method does not implement the Extractable interface. Class name = %s.',
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
     * The start of a placeholder with slashes
     * @var string START_PLACEHOLDER_SLASHED
     */
    const START_PLACEHOLDER_SLASHED = '\{\{';
    /**
     * The end of a placeholder with slashes
     * @var string END_PLACEHOLDER_SLASHED
     */
    const END_PLACEHOLDER_SLASHED = '\}\}';
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
     * ArrayHelper constructor.
     *
     * @param ArrayObject|null $array
     */
    public function __construct(ArrayObject $array =  NULL)
    {
        $this->setArray($array);
    }

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
                throw new \RuntimeException(sprintf($this->getErrorFromConstant('notExtractable')['message'], get_class($object)));
            }
            $extracted = $object->extractValues();
            foreach ($extracted as  $key => $value){
                $array[$key] = $value;
            }
        }
        $this->setArray($array);
        return $array;
    }
    /** @noinspection MoreThanThreeArgumentsInspection */

    /**
     * Automatically detects what operations should be run on a value and then runs them.
     * Remember to put ? at the strong of any string you want to be automatically handled by this method.
     *
     * @param mixed $value
     * @param array $extra
     * @param bool $pathRequired
     * @param bool $parsePathResult
     * @return array|ArrayObject|mixed|string
     * @throws \RuntimeException
     */
    public function parse($value, array $extra=[], $pathRequired=false, $parsePathResult = true){
        if ($value instanceof Closure) {
            return $this->parseClosure($value, $extra);
        }

        if (is_array($value)) {
         return $this->parseInheritance($value);
        }

        if (is_string($value) && $value[0] === static::TRIGGER_STRING_PARSE) {
            $value = $this->trimFront($value);
            if ($value[0] === static::PATH_SEPARATOR) {
                return $this->parseStringPath($value, $extra, $pathRequired, $parsePathResult);
            }

            return $this->parseTemplate($value, $extra, $pathRequired, $parsePathResult);
        }

        return $value;

    }

    /**
     * Parses a closure and passes it $this
     *
     * @param Closure $closure
     * @param array $extra
     * @return mixed
     */
    public function parseClosure(Closure $closure, array $extra=[]) {
        return $closure($extra, $this);
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
        if (count($extends) === 0 ) {
            return $source;
        }
        $origExtends = $extends;
        $result = [];
        while (count($extends)>0) {
            $extend = array_pop($extends);
            $target = $this->parseStringPath($extend, [], false, false);
            /** @noinspection SlowArrayOperationsInLoopInspection */
            $result = array_replace_recursive($result, $target);
        }
        $result = array_replace_recursive($result, $source);
        $result[static::EXTENDED_KEY] = $origExtends;
        unset($result[static::EXTENDS_KEY]);
        return $result;
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
     *    'extends'=>[':two', ':four']
     *  ]
     * You would get a result of:
     * ["two", "one", "base", "four"]
     * @param array $source
     * @return array
     * @throws \RuntimeException
     */
    public function parseInheritancePath(array $source):array{
        if (!isset($source[static::EXTENDS_KEY])) {
            return [];
        }

        /** @var array $extendsList */
        $extendsList = $source[static::EXTENDS_KEY];

        /** @noinspection CallableInLoopTerminationConditionInspection */
        for($n=0; $n<count($extendsList); $n++) {
            $extends = $extendsList[$n];
            $target = $this->parseStringPath($extends, [], false, false);
            if (isset($target[static::EXTENDS_KEY]) && is_array($target[static::EXTENDS_KEY]) && count($target[static::EXTENDS_KEY]) > 0) {
                $targetExtends = $target[static::EXTENDS_KEY];
                array_splice($extendsList,$n+1,0,$targetExtends);
                if (count($extendsList) !== count(array_count_values($extendsList))) {
                    throw new \RuntimeException(sprintf($this->getErrorFromConstant('circularInheritanceDetected')['message'], json_encode($extendsList)));
                }
            }
        }

        return $extendsList;
    }

    /** @noinspection MoreThanThreeArgumentsInspection */

    /**
     * Replaces placeholder values wrapped in {{}} with the paths stored inside them.
     * For instance
     * ?{{:key1:subKey1:subKey2}} would return "foo" from array:
     * [
     *  'key1' => [
     *      'subKey1' => [
     *          'subKey2' => 'foo'
     *      ]
     *  ]
     * ]
     *
     * @param string $template
     * @param array $extra
     * @param bool $pathRequired
     * @param bool $parsePathResult
     * @return string
     * @throws \RuntimeException
     */
    public function parseTemplate(string $template, array $extra=[], bool $pathRequired=false, bool $parsePathResult = true):string{
        $template = $this->trimFront($template);
        preg_match_all(static::PLACEHOLDER_REGEX, $template, $matches);
        $replacements =  [];
        $patterns = [];
        /** @var array[] $matches */
        foreach($matches[0] as $match) {
            $patterns[] = '/' . static::START_PLACEHOLDER_SLASHED . $match . static::END_PLACEHOLDER_SLASHED . '/';
            $replacements[] = $this->parseStringPath($match, $extra, $pathRequired, $parsePathResult);
        }
        return preg_replace($patterns, $replacements, $template);
    }
    /** @noinspection MoreThanThreeArgumentsInspection */


    /**
     * Gets an value from the array, using a : separated list of array keys passed in as a string. For instance
     * ?:key1:subKey1:subKey2 would return "foo" from array:
     * [
     *  'key1' => [
     *      'subKey1' => [
     *          'subKey2' => 'foo'
     *      ]
     *  ]
     * ]
     *
     * @param string $path
     * @param array $extra
     * @param bool $pathRequired
     * @param bool $parsePathResult
     * @return mixed
     * @throws \RuntimeException
     */
    public function parseStringPath(string $path, array $extra = [], bool $pathRequired=false, bool $parsePathResult = true) {
        $path = $this->trimFront($path);
        if ($path[0] !== static::PATH_SEPARATOR) {
            throw new \RuntimeException(sprintf($this->getErrorFromConstant('stringPathDoesNotStartWith')['message'], $path));
        }
        $path = ltrim($path, static::PATH_SEPARATOR);
        $pathArray =  preg_split('/' . static::PATH_SEPARATOR . '/', $path);
        return $this->parseArrayPath($pathArray, $extra, $pathRequired, $parsePathResult);
    }
    /** @noinspection MoreThanThreeArgumentsInspection */

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
     * @param array $extra
     * @param bool $pathRequired
     * @param bool $parsePathResult
     * @return mixed
     * @throws \RuntimeException
     */
    public function parseArrayPath(array $path, array $extra = [], bool $pathRequired=false, bool $parsePathResult = true) {
        $result = $this->getArray();
        foreach ($path as $pathPiece) {
            if ($pathRequired === false ) {
                if (isset($result[$pathPiece])) {
                    $result = $result[$pathPiece];
                } else {
                    return null;
                }
            } else {
                $result = $result[$pathPiece];
            }
        }

        return $parsePathResult === true ? $this->parse($result, $extra, $pathRequired, $parsePathResult): $result;
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
     * @return \TempestTools\Common\Contracts\ArrayHelper
     */
    public function setArray(ArrayObject $array = NULL): \TempestTools\Common\Contracts\ArrayHelper
    {
        $this->array = $array;
        return $this;
    }

    /**
     * @return ArrayObject
     */
    public function getArray(): ?ArrayObject
    {
        return $this->array;
    }
    /** @noinspection MoreThanThreeArgumentsInspection */

    /**
     * Finds the right most occurrence of a setting in the settings array, parses it if requested, and returns it.
     * If a key is passed it will look for that key in arrays passed to it.
     *
     * @param array $settings
     * @param string|null $key
     * @param bool $parse
     * @param array $extra
     * @param bool $pathRequired
     * @param bool $parsePathResult
     * @return mixed
     * @throws \RuntimeException
     */
    public function findSetting(array $settings, string $key = NULL, bool $parse = true, array $extra=[], $pathRequired=false, $parsePathResult = true) {
        for ($n=count($settings)-1;$n>=0; $n--) {
            $target = $settings[$n];
            if ($target !== NULL) {
                if ($key !== NULL) {
                    if (isset($target[$key])) {
                        return $parse === true?$this->parse($target[$key], $extra, $pathRequired, $parsePathResult):$target[$key];
                    }
                } else {
                    return $parse === true?$this->parse($target, $extra, $pathRequired, $parsePathResult):$target;
                }
            }
        }
        return NULL;
    }

    /**
     * If the array passed is associative it wraps it in a numeric array
     * @param array $array
     * @return array
     */
    public function wrapArray(array $array): array
    {
        return $this->isNumeric($array)?$array:[$array];
    }

    /**
     * Checks if an array is numeric or not, if fast is set to false it will use a more through but slightly slower method.
     * @param array $array
     * @param bool $fast
     * @return bool
     */
    public function isNumeric(array $array, $fast = true): bool
    {
        if ($fast) {
            return isset($array[0]);
        }

        return array_keys($array) !== range(0, count($array) - 1);
    }

    /**
     * @param array $values
     * @param array $enforce
     * @param array $extra
     * @return bool
     * @throws \RuntimeException
     */
    public function testEnforceValues (array $values, array $enforce, array $extra=[]):bool {
        $allowed = true;
        foreach ($enforce as $key => $value) {
            /** @noinspection NullPointerExceptionInspection */
            if ($values[$key] !== $this->parse($value, $extra)) {
                $allowed = false;
                break;
            }
        }
        return $allowed;
    }

}
