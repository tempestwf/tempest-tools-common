<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 9/27/2017
 * Time: 3:29 PM
 */

namespace TempestTools\Common\Contracts;


interface HasArrayHelperContract
{
    /**
     * Passes it's self to the extractor
     *
     * @return \ArrayObject
     * @throws \RuntimeException
     */
    public function extractSelf (): \ArrayObject;
    /**
     * @param null|ArrayHelperContract $arrayHelper
     */
    public function setArrayHelper(ArrayHelperContract $arrayHelper): void;
    /**
     * @return null|ArrayHelperContract
     */
    public function getArrayHelper():?ArrayHelperContract;

    public function arrayHelper():ArrayHelperContract;
}