<?php

namespace TempestTools\Common\Utility;

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
     */
    public function setTTConfigParsed(array $ttConfigParsed)
    {
        $this->ttConfigParsed = $ttConfigParsed;
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
     */
    public function setTTPath(array $ttPath)
    {
        $this->ttPath = $ttPath;
    }

    /**
     * @param array $ttFallBack
     */
    public function setTTFallBack(array $ttFallBack)
    {
        $this->ttFallBack = $ttFallBack;
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
     */
    public function setConfigArrayHelper(ArrayHelperContract $configArrayHelper)
    {
        $this->configArrayHelper = $configArrayHelper;
    }

}
