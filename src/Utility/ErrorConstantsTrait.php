<?php

namespace TempestTools\Common\Utility;

use TempestTools\Common\Exceptions\Utility\ErrorConstantsException;

/**
 * A trait for accessing error constants on a class.
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
trait ErrorConstantsTrait
{

    /**
     * A method for accessing error constants on a class. Throws exceptions if the trait was not applied to a class that has error constants on it.
     *
     * @param string $errorName
     * @return array
     * @throws \TempestTools\Common\Exceptions\Utility\ErrorConstantsException
     */
    public function getErrorFromConstant (string $errorName): array
    {
        if (static::ERRORS === null) {
            throw ErrorConstantsException::mustHaveErrorsConstant(get_class($this));
        }

        if (!isset(static::ERRORS[$errorName])) {
            throw ErrorConstantsException::mustHaveErrorsConstant($errorName);
        }
        return static::ERRORS[$errorName];
    }
}
