<?php

namespace TempestTools\Common\Utility;


use TempestTools\Common\Contracts\TTConfig;
use TempestTools\Common\Helper\ArrayHelper;
use \TempestTools\Common\Contracts\ArrayHelper as ArrayHelperContract;

trait TTConfigTrait
{
    /**
     * @var array $parsedTTConfig
     */
    protected $ttConfigParsed = [];

    /**
     * @var array $ttPath
     */
    protected $ttPath = [];

    /**
     * @var array $ttFallBack
     */
    protected $ttFallBack = [];

    /**
     * @var ArrayHelper|NULL $configArrayHelper;
     */
    protected $configArrayHelper;

    /**
     * Tags a config and a path, gets the element in the path in the config, and then uses an array helper to parse
     * it's inheritance. Sets the result on parsedConfig property
     *
     * @throws \RuntimeException
     * @return array
     */
    public function parseTTConfig():array
    {
        $config = $this->getTTConfig();
        $path = $this->getTTPath();
        $fallBack = $this->getTTFallBack();
        $arrayHelper =  new ArrayHelper($config);
        $target = $arrayHelper->parseArrayPath($path);
        $target = $target ?? $arrayHelper->parseArrayPath($fallBack);
        $result = $arrayHelper->parseInheritance($target);
        $this->setTTConfigParsed($result);
        $this->setConfigArrayHelper($arrayHelper);
        return $result;
    }

    /**
     * @param array $ttConfigParsed
     * @return TTConfigTrait|TTConfig
     */
    public function setTTConfigParsed(array $ttConfigParsed): TTConfig
    {
        $this->ttConfigParsed = $ttConfigParsed;
        return $this;
    }

    /**
     * @return array
     */
    public function getTTConfigParsed(): array
    {
        return $this->ttConfigParsed;
    }

    /**
     * @return array
     */
    public function getTTConfig(): array
    {
        return [];
    }

    /**
     * @param array $ttPath
     * @return TTConfigTrait|TTConfig
     */
    public function setTTPath(array $ttPath): TTConfig
    {
        $this->ttPath = $ttPath;
        return $this;
    }

    /**
     * @param array $ttFallBack
     * @return TTConfigTrait|TTConfig
     */
    public function setTTFallBack(array $ttFallBack): TTConfig
    {
        $this->ttFallBack = $ttFallBack;
        return $this;
    }

    /**
     * @return array
     */
    public function getTTPath(): array
    {
        return $this->ttPath;
    }

    /**
     * @return array
     */
    public function getTTFallBack(): array
    {
        return $this->ttFallBack;
    }

    /**
     * @return NULL|ArrayHelperContract
     */
    public function getConfigArrayHelper():ArrayHelperContract
    {
        return $this->configArrayHelper;
    }

    /**
     * @param NULL|ArrayHelperContract $configArrayHelper
     * @return TTConfigTrait|TTConfig
     */
    public function setConfigArrayHelper(ArrayHelperContract $configArrayHelper):TTConfig
    {
        $this->configArrayHelper = $configArrayHelper;
        return $this;
    }

}
