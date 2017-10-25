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

/**
 * An array expression for parsing array paths. Which is to say an array that specifies a path in another array through it's array keys.
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
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
     *
     * @param ArrayHelperContract $arrayHelper
     * @param array $extra
     * @param bool $pathRequired
     * @param bool $parsePathResult
     * @return mixed
     * @throws \RuntimeException
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