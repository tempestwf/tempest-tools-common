<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 9/27/2017
 * Time: 3:39 PM
 */

namespace TempestTools\Common\Contracts;


use TempestTools\AclMiddleware\Contracts\HasIdContract;

interface HasUserContract
{
    public function getUser():?HasIdContract;
}