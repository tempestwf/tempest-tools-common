<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 8/19/2017
 * Time: 5:54 PM
 */

namespace TempestTools\Common\ArrayExpressions;


use TempestTools\Common\Contracts\ArrayExpressionContract;
use TempestTools\Common\Contracts\ArrayHelperContract;

class ArrayInheritanceArrayExpression implements ArrayExpressionContract
{
    /**
     * @var array $array
     */
    protected $array;

    /**
     * TemplateArrayExpression constructor.
     *
     * @param array $path
     */
    public function __construct(array $path)
    {
        $this->setArray($path);
    }

    /** @noinspection MoreThanThreeArgumentsInspection */

    /**
     * Uses array helper to parse the data stored on the object
     * @param ArrayHelperContract $arrayHelper
     * @param array $extra
     * @param bool $pathRequired
     * @param bool $parsePathResult
     * @return mixed
     */
    public function parse(ArrayHelperContract $arrayHelper, array $extra=[], $pathRequired=false, $parsePathResult = true)
    {
        return $arrayHelper->parseInheritance($this->getArray());
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        return $this->array;
    }

    /**
     * @param array $array
     */
    public function setArray(array $array):void
    {
        $this->array = $array;
    }


}