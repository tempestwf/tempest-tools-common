<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 10/6/2017
 * Time: 2:54 PM
 */

namespace TempestTools\Common\ArrayObject;


use ArrayObject;
use TempestTools\Common\Exceptions\ArrayObject\ArrayObjectException;

/**
 * An abstract class that lets defaults be applied automatically to an array object, and also lets certain keys be fixed so they can't be changed again after first being set.
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
abstract class TTArrayObjectAbstract extends ArrayObject
{
    /**
     * @var array $defaults
     */
    protected $defaults = [];

    /**
     * @var array
     */
    protected $fixed = [];

    /**
     * Construct a new array object
     * @link http://php.net/manual/en/arrayobject.construct.php
     * @param array|object $input The input parameter accepts an array or an Object.
     * @param int $flags Flags to control the behaviour of the ArrayObject object.
     * @param string $iterator_class Specify the class that will be used for iteration of the ArrayObject object. ArrayIterator is the default class used.
     * @since 5.0.0
     *
     */
    public function __construct($input = array(), $flags = 0, $iterator_class = 'ArrayIterator') {
        $defaults = $this->getDefaults();
        $input = array_replace($defaults, $input);
        parent::__construct($input, $flags, $iterator_class);
    }

    /**
     * Validates a key to make sure is allowed to be changed
     * @param mixed $key
     * @param null $newval
     * @throws \TempestTools\Common\Exceptions\ArrayObject\ArrayObjectException
     */
    protected function validateKey($key, $newval= null) {
        /** @noinspection NotOptimalIfConditionsInspection */
        if ($this->offsetExists($key) === true && $this->offsetGet($key) !== null && $this->offsetGet($key) !== [] && in_array($key, $this->getFixed(), true)) {
            throw ArrayObjectException::keyIsFixed($key);
        }
    }

    /**
     * Sets the value at the specified index to newval. It also calls a validation method to make sure the key can be set.
     *
     * @link http://php.net/manual/en/arrayobject.offsetset.php
     * @param mixed $index <p>
     * The index being set.
     * </p>
     * @param mixed $newval <p>
     * The new value for the <i>index</i>.
     * </p>
     * @return void
     * @throws \TempestTools\Common\Exceptions\ArrayObject\ArrayObjectException
     * @since 5.0.0
     */
    public function offsetSet($index, $newval) {
        $this->validateKey($index, $newval);
        parent::offsetSet($index, $newval);
    }

    /**
     * Unsets the value at the specified index. It also calls a validation method to make sure the key can be set.
     *
     * @link http://php.net/manual/en/arrayobject.offsetunset.php
     * @param mixed $index <p>
     * The index being unset.
     * </p>
     * @return void
     * @throws \TempestTools\Common\Exceptions\ArrayObject\ArrayObjectException
     * @since 5.0.0
     */
    public function offsetUnset($index) {
        $this->validateKey($index);
        parent::offsetUnset($index);
    }

    /**
     * @return array
     */
    public function getDefaults(): array
    {
        return $this->defaults;
    }

    /**
     * @param array $defaults
     */
    public function setDefaults(array $defaults)
    {
        $this->defaults = $defaults;
    }

    /**
     * @return array
     */
    public function getFixed(): array
    {
        return $this->fixed;
    }

    /**
     * @param array $fixed
     */
    public function setFixed(array $fixed)
    {
        $this->fixed = $fixed;
    }
}