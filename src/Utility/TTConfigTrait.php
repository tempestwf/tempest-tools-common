<?php

namespace TempestTools\Common\Utility;

use ArrayObject;
use TempestTools\Common\Contracts\ArrayHelperContract;
use TempestTools\Common\Exceptions\Utility\TTConfigException;
use TempestTools\Common\Helper\ArrayHelper;
use TempestTools\Common\Helper\ArrayHelperTrait;

/**
 * A trait for adding Tempest Tools Configuration related convenience methods.
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
trait TTConfigTrait
{
    use ArrayHelperTrait;
    /**
     * @var array $ttPath
     */
    protected $ttPath;

    /**
     * @var array $ttFallBack
     */
    protected $ttFallBack;

    /**
     * @var array $ttPath
     */
    protected $ttPathNoMode;

    /**
     * @var array $ttFallBack
     */
    protected $ttFallBackNoMode;

    /**
     * @var ArrayHelper|NULL $configArrayHelper;
     */
    protected $configArrayHelper;

    /**
     * @return array
     */
    public function getTTPathNoMode(): array
    {
        return $this->ttPathNoMode;
    }

    /**
     * @param array $ttPathNoMode
     */
    public function setTTPathNoMode(array $ttPathNoMode):void
    {
        $this->ttPathNoMode = $ttPathNoMode;
    }

    /**
     * @return array
     */
    public function getTTFallBackNoMode(): array
    {
        return $this->ttFallBackNoMode;
    }

    /**
     * @param array $ttFallBackNoMode
     */
    public function setTTFallBackNoMode(array $ttFallBackNoMode):void
    {
        $this->ttFallBackNoMode = $ttFallBackNoMode;
    }

    /**
     * Gets the modes that are available to be used on the class. Modes are part of a Tempest Tools Config path.
     * @return array
     */
    abstract public function getAvailableModes(): array;


    /**
     * Tags a config and a path, gets the element in the path in the config, and then uses an array helper to parse
     * it's inheritance. Sets the result on parsedConfig property
     *
     * @param ArrayHelperContract|null $substituteArrayHelper
     * @return array
     * @throws \RuntimeException
     */
    protected function parseTTConfig(ArrayHelperContract $substituteArrayHelper = NULL):array
    {
        $config = $this->getTTConfig();
        $path = $this->getTTPath();
        $fallBack = $this->getTTFallBack();
        $arrayHelper = $substituteArrayHelper === NULL?new ArrayHelper(new ArrayObject($config)):$substituteArrayHelper->setArray(new ArrayObject($config));
        $target = $arrayHelper->parseArrayPath($path, [], false, false);
        $target = $target ?? $arrayHelper->parseArrayPath($fallBack, [], false, false);
        if ($target === null) {
            throw TTConfigException::pathAndFallBackNotFound($path, $fallBack);
        }
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
     * Common logic for checking if the permissive settings allow something to be done
     * @param array|\ArrayObject $high
     * @param array $low
     * @param string $canDo
     * @param string $target
     * @return bool
     */
    public function permissivePermissionCheck ($high, array $low, string $canDo, string $target):bool {
        $highPermissive = $high['permissive'] ?? true;
        $allowed = $low !== NULL && isset($low['permissive']) ? $low['permissive']:$highPermissive;
        return $low[$canDo][$target] ?? $allowed;
    }

    /**
     * Common logic for checking if settings allow something to be done by looking at a high level settings and a lower more specific level setting.
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
     * Common logic for checking if the permissive settings allow something to be done
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
     * Initializes the configuration
     * @param ArrayHelperContract|null $arrayHelper
     * @param array|null $path
     * @param array|null $fallBack
     * @param bool $force
     * @param string|null $mode
     * @throws TTConfigException
     * @return bool
     */
    protected function coreInit (ArrayHelperContract $arrayHelper = NULL, array $path=NULL, array $fallBack=NULL, bool $force= true, string $mode = null):bool
    {
        if ($mode !== null && in_array($mode, $this->getAvailableModes(), true) === false) {
            throw TTConfigException::modeNotRecognized($mode);
        }

        $updated = false;
        if ($arrayHelper !== null && ($force === true || $this->getArrayHelper() === null)) {
            $updated= true;
            $this->setArrayHelper($arrayHelper);
        }

        $lastPath = $this->getTTPath();
        if ($path !== null && ($force === true || $lastPath  === null || $path !== $lastPath)) {
            $updated= true;
            if ($mode !== null) {
                $this->setTTPathNoMode($path);
                if (in_array(end($path), $this->getAvailableModes(), true)) {
                    $path[count($path) - 1] = $mode;
                } else {
                    $path[] = $mode;
                }

            }
            $this->setTTPath($path);
        }

        $lastFallBack = $this->getTTFallBack();
        if ($fallBack !== null && ($force === true || $lastFallBack === null || $fallBack !== $lastFallBack )) {
            $updated= true;
            if ($mode !== null) {
                $this->setTTFallBackNoMode($fallBack);
                if (in_array(end($fallBack), $this->getAvailableModes(), true)) {
                    $fallBack[count($fallBack) - 1] = $mode;
                } else {
                    $fallBack[] = $mode;
                }
            }
            $this->setTTFallBack($fallBack);
        }

        if (!$this->getArrayHelper() instanceof ArrayHelperContract) {
            throw TTConfigException::noArrayHelperFound();
        }
        return $updated;
    }



}
