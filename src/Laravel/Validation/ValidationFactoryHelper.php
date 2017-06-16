<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 6/15/2017
 * Time: 5:48 PM
 */

namespace TempestTools\Common\Laravel\Validation;


use Illuminate\Contracts\Validation\Factory;
use TempestTools\Common\Contracts\ValidationFactoryHelper as ValidationFactoryHelperContract;

class ValidationFactoryHelper implements ValidationFactoryHelperContract
{
    /**
     * Gets a validation factory
     */
    public function getValidationFactory(): Factory {
        return app(Factory::class);
    }
}