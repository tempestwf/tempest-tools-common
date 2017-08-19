<?php

namespace TempestTools\Common\Utility;

use ArrayObject;
use TempestTools\Common\Contracts\ArrayHelperContract;
use TempestTools\Common\Helper\ArrayHelper;
use TempestTools\Common\Helper\ArrayHelperTrait;

trait TTConfigTrait
{

    use ArrayHelperTrait, ErrorConstantsTrait;
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
     * @return NULL|ArrayHelper
     */
    public function getConfigArrayHelper():?ArrayHelper
    {
        return $this->configArrayHelper;
    }

    /**
     * @param ArrayHelper $configArrayHelper
     */
    public function setConfigArrayHelper(ArrayHelper $configArrayHelper): void
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


    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * Common logic for checking if the permissive settings allow something to be don
     * @param array|\ArrayObject $high
     * @param array $low
     * @return bool
     */
    public function permissiveAllowedCheck ($high, array $low):bool {
        $highPermissive = $high['permissive'] ?? true;
        $allowed = $low !== NULL && isset($low['allowed']) ? $low['allowed']:$highPermissive;

        return $allowed;
    }

    /** @noinspection MoreThanThreeArgumentsInspection */

    /**
     * @param ArrayHelperContract|null $arrayHelper
     * @param array|null $path
     * @param array|null $fallBack
     * @param bool $force
     * @param string|null $mode
     * @throws \RuntimeException
     * @return bool
     */
    public function coreInit (ArrayHelperContract $arrayHelper = NULL, array $path=NULL, array $fallBack=NULL, bool $force= true, string $mode = null):bool
    {
        $updated = false;
        if ($arrayHelper !== null && ($force === true || $this->getArrayHelper() === null)) {
            $updated= true;
            $this->setArrayHelper($arrayHelper);
        }

        if ($path !== null && ($force === true || $this->getTTPath() === null || $path !== $this->getTTPath())) {
            $updated= true;
            if ($mode !== null) {
                $path[] = $mode;
            }
            $this->setTTPath($path);
        }

        if ($fallBack !== null && ($force === true || $this->getTTFallBack() === null || $fallBack !== $this->getTTFallBack() )) {
            $updated= true;
            $this->setTTFallBack($fallBack);
            if ($mode !== null) {
                $path[] = $mode;
            }
            $this->setTTFallBack($path);
        }

        if (!$this->getArrayHelper() instanceof ArrayHelperContract) {
            throw new \RuntimeException('Error: No array helper on entity.');
        }
        return $updated;
    }



}
