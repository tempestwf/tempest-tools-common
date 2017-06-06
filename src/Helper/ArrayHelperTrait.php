<?php

namespace TempestTools\Common\Helper;

use TempestTools\Common\Contracts\ArrayHelper;

trait ArrayHelperTrait
{
    /**
     * @var ArrayHelper|null $arrayHelper
     */
    protected $arrayHelper;

    /**
     * @param null|ArrayHelper $arrayHelper
     * @return ArrayHelperTrait
     */
    public function setArrayHelper(ArrayHelper $arrayHelper)
    {
        $this->arrayHelper = $arrayHelper;
        return $this;
    }

    /**
     * @return null|ArrayHelper
     */
    public function getArrayHelper()
    {
        return $this->arrayHelper;
    }

}
