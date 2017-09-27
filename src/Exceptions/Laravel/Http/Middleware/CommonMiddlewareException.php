<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 9/27/2017
 * Time: 3:55 PM
 */

namespace TempestTools\Common\Exceptions\Laravel\Http\Middleware;


class CommonMiddlewareException extends \RunTimeException
{
    /**
     * @return CommonMiddlewareException
     */
    public static function controllerDoesNotImplementHasArrayHelperContract (): CommonMiddlewareException
    {
        return new self (sprintf('Error: Middleware used on a controller that does not implement the HasArrayHelperContract'));
    }

    /**
     * @return CommonMiddlewareException
     */
    public static function controllerDoesNotImplementHasUserContract (): CommonMiddlewareException
    {
        return new self (sprintf('Error: Middleware used on a controller that does not implement the HasUserContract'));
    }
}