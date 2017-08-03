<?php

namespace TempestTools\Common\Utility;

use ArrayObject;
use TempestTools\Common\Helper\ArrayHelper;
use \TempestTools\Common\Contracts\ArrayHelper as ArrayHelperContract;

trait TTConfigTrait
{

    /**
     * @var array $ttPath
     */
    protected $ttPath;

    /**
     * @var array $ttFallBack
     */
    protected $ttFallBack;

    /**
     * @var ArrayHelper|NULL $configArrayHelper;
     */
    protected $configArrayHelper;

    /**
     * Tags a config and a path, gets the element in the path in the config, and then uses an array helper to parse
     * it's inheritance. Sets the result on parsedConfig property
     *
     * @param ArrayHelperContract|null $substituteArrayHelper
     * @return array
     * @throws \RuntimeException
     */
    public function parseTTConfig(ArrayHelperContract $substituteArrayHelper = NULL):array
    {
        $config = $this->getTTConfig();
        $path = $this->getTTPath();
        $fallBack = $this->getTTFallBack();
        $arrayHelper = $substituteArrayHelper === NULL?new ArrayHelper(new ArrayObject($config)):$substituteArrayHelper->setArray(new ArrayObject($config));
        $target = $arrayHelper->parseArrayPath($path);
        $target = $target ?? $arrayHelper->parseArrayPath($fallBack);
        $result = $arrayHelper->parseInheritance($target);
        $arrayHelper->setArray(new ArrayObject($result));
        $this->setConfigArrayHelper($arrayHelper);
        return $result;
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
    public function setTTPath(array $ttPath): void
    {
        $this->ttPath = $ttPath;
    }

    /**
     * @param array $ttFallBack
     */
    public function setTTFallBack(array $ttFallBack): void
    {
        $this->ttFallBack = $ttFallBack;
    }

    /**
     * @return NULL|array
     */
    public function getTTPath(): ?array
    {
        return $this->ttPath;
    }

    /**
     * @return NULL|array
     */
    public function getTTFallBack(): ?array
    {
        return $this->ttFallBack;
    }

    /**
     * @return NULL|ArrayHelperContract
     */
    public function getConfigArrayHelper():?ArrayHelperContract
    {
        return $this->configArrayHelper;
    }

    /**
     * @param ArrayHelperContract $configArrayHelper
     */
    public function setConfigArrayHelper(ArrayHelperContract $configArrayHelper): void
    {
        $this->configArrayHelper = $configArrayHelper;
    }

    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * Common logic for checking if the permissive settings allow something to be don
     * @param array|\ArrayObject $high
     * @param array $low
     * @param string $canDo
     * @param string $target
     * @return bool
     */
    public function permissivePermissionCheck ($high, array $low, string $canDo, string $target):bool {
        $highPermissive = $high['permissive'] ?? true;
        $allowed = $low !== NULL && isset($low['permissive']) ? $low['permissive']:$highPermissive;
        $allowed = $low[$canDo][$target] ?? $allowed;

        return $allowed;
    }

    /**
     * @param array|\ArrayObject $high
     * @param array $low
     * @param string $setting
     * @return bool|mixed|null
     */
    public function highLowSettingCheck($high, array $low = NULL, string $setting){
        $highSet = isset($high[$setting]) ?? $high[$setting];
        return $low !== NULL && isset($low[$setting]) ? $low[$setting]:$highSet;
    }



}
