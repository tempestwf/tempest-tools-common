<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 6/15/2017
 * Time: 5:48 PM
 */

namespace TempestTools\Common\Contracts;


use \Illuminate\Contracts\Validation\Factory;

interface ValidationFactoryHelper
{

    public function getValidationFactory(): Factory;
}