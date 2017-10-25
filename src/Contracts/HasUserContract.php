<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 9/27/2017
 * Time: 3:39 PM
 */

namespace TempestTools\Common\Contracts;


use TempestTools\AclMiddleware\Contracts\HasIdContract;

/**
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
interface HasUserContract
{
    /**
     * @return null|HasIdContract
     */
    public function getUser():?HasIdContract;
}