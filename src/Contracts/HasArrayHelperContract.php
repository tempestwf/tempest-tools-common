<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 9/27/2017
 * Time: 3:29 PM
 */

namespace TempestTools\Common\Contracts;

/**
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
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

    /**
     * @return ArrayHelperContract
     */
    public function arrayHelper():ArrayHelperContract;
}