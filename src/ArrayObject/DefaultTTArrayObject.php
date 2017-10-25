<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 10/6/2017
 * Time: 2:44 PM
 */

namespace TempestTools\Common\ArrayObject;


use TempestTools\Common\Constants\CommonArrayObjectKeyConstants;

/**
 * An array object that automatically populates it's self with Defaults, and makes sure that if some one tries to change a key in fixed after the fact it will through an Exception.
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
class DefaultTTArrayObject extends TTArrayObjectAbstract
{

    /**
     * @var array $defaults
     */
    protected /** @noinspection ClassOverridesFieldOfSuperClassInspection */ $defaults = [
        CommonArrayObjectKeyConstants::FRAMEWORK_KEY_NAME=>[],
        CommonArrayObjectKeyConstants::USER_KEY_NAME=>null,
        CommonArrayObjectKeyConstants::ORM_KEY_NAME=>[],
        CommonArrayObjectKeyConstants::SESSION_KEY_NAME=>[],
        CommonArrayObjectKeyConstants::CUSTOM_KEY_NAME=>[],
    ];

    /**
     * @var array
     */
    protected /** @noinspection ClassOverridesFieldOfSuperClassInspection */ $fixed = [
        CommonArrayObjectKeyConstants::FRAMEWORK_KEY_NAME,
        CommonArrayObjectKeyConstants::USER_KEY_NAME,
    ];
}