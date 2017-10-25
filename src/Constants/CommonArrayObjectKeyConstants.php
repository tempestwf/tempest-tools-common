<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 10/6/2017
 * Time: 2:46 PM
 */

namespace TempestTools\Common\Constants;


/**
 * A constants class that lists the keys that will commonly be stored on a shared array object.
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
class CommonArrayObjectKeyConstants
{
    /**
     * A key for storing information extracted that is related to information from the framework (such as info about the request, the route, the config, etc).
     */
    const FRAMEWORK_KEY_NAME = 'framework';
    /**
     * A key for storing information extracted that is related to the current sessions user.
     */
    const USER_KEY_NAME = 'user';
    /**
     * A key for storing information related to the ORM. Such as entities that have been preloaded to save additional calls to the DB when they aren't necessary.
     */
    const ORM_KEY_NAME = 'orm';
    /**
     * A key for storing information related to the sessions.
     */
    const SESSION_KEY_NAME = 'session';
    /**
     * A key for storing information that is custom.
     */
    const CUSTOM_KEY_NAME = 'custom';

    /**
     * Gets all the keys in an array
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