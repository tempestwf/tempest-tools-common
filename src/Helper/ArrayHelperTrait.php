<?php

namespace TempestTools\Common\Helper;


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
        return $this->arrayHelper()->extract([$this]);
    }

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
