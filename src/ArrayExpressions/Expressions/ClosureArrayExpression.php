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

class ClosureArrayExpression implements ArrayExpressionContract
{
    /**
     * @var \Closure $closure
     */
    protected $closure;

    /**
     * TemplateArrayExpression constructor.
     *
     * @param \Closure $closure
     */
    public function __construct(\Closure $closure)
    {
        $this->setClosure($closure);
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
        return $arrayHelper->parseClosure($this->getClosure(), $extra);
    }

    /**
     * @return \Closure
     */
    public function getClosure(): \Closure
    {
        return $this->closure;
    }

    /**
     * @param \Closure $closure
     */
    public function setClosure(\Closure $closure):void
    {
        $this->closure = $closure;
    }


}