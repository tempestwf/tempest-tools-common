<?php

namespace TempestTools\Common\Helper;

use \TempestTools\Common\Contracts\ArrayHelperContract;

/**
 * Trait that puts convenience methods related to array helpers on a class
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
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
    public function setArrayHelper(ArrayHelperContract $arrayHelper): void
    {
        $this->arrayHelper = $arrayHelper;
    }

    /**
     * @return null|ArrayHelperContract
     */
    public function getArrayHelper():?ArrayHelperContract
    {
        return $this->arrayHelper;
    }

    /**
     * Gets existing array helper, or makes new one and then returns it
     *
     * @return null|ArrayHelperContract
     */
    public function arrayHelper():ArrayHelperContract {
        $arrayHelper = $this->getArrayHelper();
        if ($arrayHelper === NULL) {
            $arrayHelper = new ArrayHelper();
            $this->setArrayHelper($arrayHelper);
        }
        return $arrayHelper;
    }

}
