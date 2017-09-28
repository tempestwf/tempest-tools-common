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
     * @param string $interface
     * @return CommonMiddlewareException
     */
    public static function controllerDoesNotImplement(string $interface): CommonMiddlewareException
    {
        return new self (sprintf('Error: Middleware used on a controller that does not implement the %s', $interface));
    }
}