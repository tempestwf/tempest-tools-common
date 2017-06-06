<?php

namespace TempestTools\Common\Contracts;

use ArrayObject;
use Closure;

interface ArrayHelper
{

    public function __construct(ArrayObject $array =  NULL);

    public function extract(array $objects):ArrayObject;

    public function parse($value);

    public function parseClosure(Closure $closure);

    public function parseInheritance(array $source):array;

    public function parseInheritancePath(array $source):array;

    public function parseTemplate(string $template):string;

    public function parseStringPath(string $path);

    public function parseArrayPath(array $path);

    public function setArray(ArrayObject $array = NULL): \TempestTools\Common\Helper\ArrayHelper;

    public function getArray(): ?ArrayObject;

}
