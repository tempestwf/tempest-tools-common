<?php

namespace TempestTools\Common\Utility;

use TempestTools\Common\Exceptions\ErrorConstantsException;

trait ErrorConstantsTrait
{
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
