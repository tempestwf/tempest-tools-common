<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 8/19/2017
 * Time: 5:52 PM
 */

namespace TempestTools\Common\Contracts;


interface ArrayExpressionContract
{
    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * @param ArrayHelperContract $arrayHelper
     * @param array $extra
     * @param bool $pathRequired
     * @param bool $parsePathResult
     * @return mixed
     * @internal param $value
     */
    public function parse(ArrayHelperContract $arrayHelper, array $extra=[], $pathRequired=false, $parsePathResult = true);
}