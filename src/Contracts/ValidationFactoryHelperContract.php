<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 6/15/2017
 * Time: 5:48 PM
 */

namespace TempestTools\Common\Contracts;


use \Illuminate\Contracts\Validation\Factory;

/**
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
interface ValidationFactoryHelperContract
{

    /**
     * @return Factory
     */
    public function getValidationFactory(): Factory;
}