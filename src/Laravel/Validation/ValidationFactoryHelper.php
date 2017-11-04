<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 6/15/2017
 * Time: 5:48 PM
 */

namespace TempestTools\Common\Laravel\Validation;


use Illuminate\Contracts\Validation\Factory;
use TempestTools\Common\Contracts\ValidationFactoryHelperContract;

/**
 * A helper class to get a validation factory
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
class ValidationFactoryHelper implements ValidationFactoryHelperContract
{
    /**
     * Gets a validation factory
     */
    public function getValidationFactory(): Factory {
        return app(Factory::class);
    }
}