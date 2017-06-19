<?php

namespace TempestTools\Common\Contracts;

use ArrayObject;
use Closure;

interface ArrayHelper
{

    public function __construct(ArrayObject $array =  NULL);

    public function extract(array $objects):ArrayObject;

    /** @noinspection MoreThanThreeArgumentsInspection
     * @param $value
     * @param array $extra
     * @param bool $pathRequired
     * @param bool $parsePathResult
     * @return
     */
    public function parse($value, array $extra=[], $pathRequired=false, $parsePathResult = true);

    public function parseClosure(Closure $closure, array $extra = []);

    public function parseInheritance(array $source):array;

    public function parseInheritancePath(array $source):array;

    /** @noinspection MoreThanThreeArgumentsInspection
     * @param string $template
     * @param array $extra
     * @param bool $pathRequired
     * @param bool $parsePathResult
     * @return string
     */
    public function parseTemplate(string $template, array $extra=[], bool $pathRequired=false, bool $parsePathResult = true):string;

    /** @noinspection MoreThanThreeArgumentsInspection
     * @param string $path
     * @param array $extra
     * @param bool $pathRequired
     * @param bool $parsePathResult
     * @return
     */
    public function parseStringPath(string $path, array $extra = [], bool $pathRequired=false, bool $parsePathResult = true);

    /** @noinspection MoreThanThreeArgumentsInspection
     * @param array $path
     * @param array $extra
     * @param bool $pathRequired
     * @param bool $parsePathResult
     * @return
     */
    public function parseArrayPath(array $path, array $extra = [], bool $pathRequired=false, bool $parsePathResult = true);

    public function setArray(ArrayObject $array = NULL): \TempestTools\Common\Helper\ArrayHelper;

    public function getArray(): ?ArrayObject;

    /** @noinspection MoreThanThreeArgumentsInspection
     * @param array $settings
     * @param string|null $key
     * @param bool $parse
     * @param array $extra
     * @param bool $pathRequired
     * @param bool $parsePathResult
     * @return
     */
    public function findSetting(array $settings, string $key = NULL, bool $parse = true, array $extra=[], $pathRequired=false, $parsePathResult = true);

    public function wrapArray(array $array): array;

    public function isNumeric(array $array, $fast = true): bool;
}
