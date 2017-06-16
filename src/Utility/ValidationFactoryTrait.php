<?php

namespace TempestTools\Common\Utility;

use TempestTools\Common\Contracts\ValidationFactoryHelper as ValidationFactoryHelperContract;


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
    public function setValidationFactoryHelper(ValidationFactoryHelperContract $validationFactoryHelper)
    {
        $this->validationFactoryHelper = $validationFactoryHelper;
    }

}
