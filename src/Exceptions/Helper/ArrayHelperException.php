<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 8/19/2017
 * Time: 6:52 PM
 */

namespace TempestTools\Common\Exceptions\Helper;


use RunTimeException;

/**
 * Exception related to array helper
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
class ArrayHelperException extends RunTimeException
{
    /**
     * @param string $path
     * @return ArrayHelperException
     */
    public static function stringPathDoesNotStartWith (string $path): ArrayHelperException
    {
        return new self (sprintf('Error: string passed to parseStringPath does not start with path separator. path = %s.', $path));
    }

    /**
     * @param string $extends
     * @return ArrayHelperException
     */
    public static function circularInheritanceDetected (string $extends): ArrayHelperException
    {
        return new self (sprintf('Error: Circular inheritance detected in array. extends = %s.', $extends));
    }

    /**
     * @param string $className
     * @return ArrayHelperException
     */
    public static function notExtractable (string $className): ArrayHelperException
    {
        return new self (sprintf('Error: object passed to extract method does not implement the Extractable interface. Class name = %s.', $className));
    }


}



