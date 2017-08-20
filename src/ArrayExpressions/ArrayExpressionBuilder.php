<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 8/19/2017
 * Time: 6:14 PM
 */

namespace TempestTools\Common\ArrayExpressions;


class ArrayExpressionBuilder
{
    /**
     * @param array $array
     * @return ArrayInheritanceArrayExpression
     */
    public static function arrayInheritance (array $array): ArrayInheritanceArrayExpression
    {
        return new ArrayInheritanceArrayExpression($array);
    }

    /**
     * @param array $array
     * @return ArrayPathArrayExpression
     */
    public static function arrayPath (array $array): ArrayPathArrayExpression
    {
        return new ArrayPathArrayExpression($array);
    }

    /**
     * @param \Closure $closure
     * @return ClosureArrayExpression
     */
    public static function closure (\Closure $closure): ClosureArrayExpression
    {
        return new ClosureArrayExpression($closure);
    }

    /**
     * @param string $string
     * @return StringPathArrayExpression
     */
    public static function stringPath (string $string): StringPathArrayExpression
    {
        return new StringPathArrayExpression($string);
    }

    /**
     * @param string $string
     * @return TemplateArrayExpression
     */
    public static function template (string $string): TemplateArrayExpression
    {
        return new TemplateArrayExpression($string);
    }
}