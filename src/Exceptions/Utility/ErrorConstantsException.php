<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 8/19/2017
 * Time: 6:52 PM
 */

namespace TempestTools\Common\Exceptions\Utility;


/**
 * Exception related error constants applied to a class via a trait.
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
class ErrorConstantsException extends \RunTimeException
{
    /**
     * @param string $className
     * @return ErrorConstantsException
     */
    public static function mustHaveErrorsConstant (string $className): ErrorConstantsException
    {
        return new self (sprintf('Error: ErrorConstantsTrait applied to a class with out an ERRORS constant. Class name = %s.', $className));
    }

    /**
     * @param string $errorName
     * @return ErrorConstantsException
     */
    public static function missingConstant (string $errorName): ErrorConstantsException
    {
        return new self (sprintf('Error: ErrorConstantsTrait was passed an error name that was not found in the ERRORS constant. Error name = %s.', $errorName));
    }



}



