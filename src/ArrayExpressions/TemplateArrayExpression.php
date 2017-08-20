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

class TemplateArrayExpression implements ArrayExpressionContract
{
    /**
     * @var string $template
     */
    protected $template;

    /**
     * TemplateArrayExpression constructor.
     *
     * @param string $template
     */
    public function __construct(string $template)
    {
        $this->setTemplate($template);
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
        return $arrayHelper->parseTemplate($this->getTemplate(), $extra, $pathRequired, $parsePathResult);
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate(string $template):void
    {
        $this->template = $template;
    }
}