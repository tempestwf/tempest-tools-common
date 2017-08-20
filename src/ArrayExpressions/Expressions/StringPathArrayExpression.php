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

class StringPathArrayExpression implements ArrayExpressionContract
{
    /**
     * @var string $path
     */
    protected $path;

    /**
     * TemplateArrayExpression constructor.
     *
     * @param string $path
     */
    public function __construct(string $path)
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
        return $arrayHelper->parseStringPath($this->getPath(), $extra, $pathRequired, $parsePathResult);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path):void
    {
        $this->path = $path;
    }


}