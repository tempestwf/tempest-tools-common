<?php

namespace TempestTools\Common\Helper;

use \TempestTools\Common\Contracts\ArrayHelper as ArrayHelperContract;


trait ArrayHelperTrait
{
    /**
     * @var ArrayHelper|null $arrayHelper
     */
    protected $arrayHelper;


    /**
     * Passes it's self to the extractor
     *
     * @return \ArrayObject
     * @throws \RuntimeException
     */
    public function extractSelf (): \ArrayObject
    {
        /** @noinspection NullPointerExceptionInspection */
        return $this->arrayHelper()->extract([$this]);
    }

    /**
     * @param null|ArrayHelperContract $arrayHelper
     */
    public function setArrayHelper(ArrayHelperContract $arrayHelper)
    {
        $this->arrayHelper = $arrayHelper;
    }

    /**
     * @return null|ArrayHelper
     */
    public function getArrayHelper():ArrayHelper
    {
        return $this->arrayHelper;
    }

    /**
     * Gets existing array helper, or makes new one and then returns it
     * @return null|ArrayHelper
     */
    public function arrayHelper():ArrayHelper {
        $arrayHelper = $this->getArrayHelper();
        if ($arrayHelper === NULL) {
            $arrayHelper = new ArrayHelper();
            $this->setArrayHelper($arrayHelper);
        }
        return $arrayHelper;
    }

}
