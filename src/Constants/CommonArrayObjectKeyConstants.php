<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 10/6/2017
 * Time: 2:46 PM
 */

namespace TempestTools\Common\Constants;


class CommonArrayObjectKeyConstants
{
    const FRAMEWORK_KEY_NAME = 'framework';
    const USER_KEY_NAME = 'user';
    const ORM_KEY_NAME = 'orm';
    const SESSION_KEY_NAME = 'session';
    const CUSTOM_KEY_NAME = 'custom';

    /**
     * @return array
     */
    public static function getAll():array
    {
        return [
            static::FRAMEWORK_KEY_NAME,
            static::USER_KEY_NAME,
            static::ORM_KEY_NAME,
            static::SESSION_KEY_NAME,
            static::CUSTOM_KEY_NAME,
        ];
    }
}