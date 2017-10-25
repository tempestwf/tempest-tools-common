<?php

namespace TempestTools\Common\Utility;

use TempestTools\Common\Contracts\ValidationFactoryHelperContract;

/**
 * A trait for getting and setting a validation factory on a class
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
trait ValidationFactoryTrait
{

    /**
     * @var ValidationFactoryHelperContract|NULL $validationFactoryHelper
     */
    protected $validationFactoryHelper;

    /**
     * @return NULL|ValidationFactoryHelperContract
     */
    public function getValidationFactoryHelper():ValidationFactoryHelperContract
    {
        return $this->validationFactoryHelper;
    }

    /**
     * @param NULL|ValidationFactoryHelperContract $validationFactoryHelper
     */
    public function setValidationFactoryHelper(ValidationFactoryHelperContract $validationFactoryHelper): void
    {
        $this->validationFactoryHelper = $validationFactoryHelper;
    }

}
