<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 10/6/2017
 * Time: 3:04 PM
 */

namespace TempestTools\Common\Exceptions\ArrayObject;


use RunTimeException;

class ArrayObjectException extends RunTimeException
{
    /**
     * @param mixed $key
     * @return ArrayObjectException
     */
    public static function keyIsFixed ($key): ArrayObjectException
    {
        return new self (sprintf('Error: the key of this array object is fixed -- it can not be set twice. key = %s.', $key));
    }
}