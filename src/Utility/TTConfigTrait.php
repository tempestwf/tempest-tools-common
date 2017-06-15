<?php

namespace TempestTools\Common\Utility;

use TempestTools\Common\Helper\ArrayHelper;
use \TempestTools\Common\Contracts\ArrayHelper as ArrayHelperContract;

trait TTConfigTrait
{

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
        $arrayHelper->setArray($result);
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
        $highPermissive = isset($high['permissive']) ?? $high['permissive'];
        $lowPermissive = $low !== NULL && isset($low['permissive']) ?? $high['permissive'];

        $allowed = true;
        $allowed = $highPermissive === false && $low === NULL?false:$allowed;
        $allowed = $lowPermissive === false && (!isset($low[$canDo]) || !isset($low[$canDo][$target]) || $low[$canDo][$target] === false) ?false:$allowed;
        $allowed = $lowPermissive === true && isset($low[$canDo]) && isset($low[$canDo][$target]) && $low[$canDo][$target] === false ?false:$allowed;

        return $allowed;
    }

    /**
     * @param array|\ArrayObject $high
     * @param array $low
     * @param string $setting
     * @return bool|mixed|null
     */
    public function highLowSettingCheck($high, array $low, string $setting){
        $highSet = isset($high[$setting]) ?? $high[$setting];
        $lowSet = $low !== NULL && isset($low[$setting]) ?? $high[$setting];
        if ($lowSet !== NULL ) {
            return $lowSet;
        }

        if ($highSet !== NULL) {
            return $highSet;
        }

        return NULL;
    }



}
