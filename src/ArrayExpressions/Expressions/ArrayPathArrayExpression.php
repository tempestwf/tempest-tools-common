<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 8/19/2017
 * Time: 5:54 PM
 */

namespace TempestTools\Common\ArrayExpressions\Expressions;


use TempestTools\Common\Contracts\ArrayExpressionContract;
use TempestTools\Common\Contracts\ArrayHelperContract;

class ArrayPathArrayExpression implements ArrayExpressionContract
{
    /**
     * @var array $path
     */
    protected $path;

    /**
     * TemplateArrayExpression constructor.
     *
     * @param array $path
     */
    public function __construct(array $path)
    {
        $this->setPath($path);
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
        return $arrayHelper->parseArrayPath($this->getPath(), $extra, $pathRequired, $parsePathResult);
    }

    /**
     * @return array
     */
    public function getPath(): array
    {
        return $this->path;
    }

    /**
     * @param array $path
     */
    public function setPath(array $path):void
    {
        $this->path = $path;
    }


}