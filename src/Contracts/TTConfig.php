<?php

namespace TempestTools\Common\Contracts;

use \TempestTools\Common\Contracts\ArrayHelper as ArrayHelperContract;


interface TTConfig
{

    public function parseTTConfig():array;

    public function setTTConfigParsed(array $ttConfigParsed): TTConfig;

    public function getTTConfigParsed(): array;

    public function getTTConfig(): array;

    public function setTTPath(array $ttPath): TTConfig;

    public function setTTFallBack(array $ttFallBack): TTConfig;

    public function getTTPath(): array;

    public function getTTFallBack(): array;

    public function getConfigArrayHelper():ArrayHelperContract;

    public function setConfigArrayHelper(ArrayHelperContract $configArrayHelper):TTConfig;
}
