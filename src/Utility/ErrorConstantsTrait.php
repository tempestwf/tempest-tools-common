<?php

namespace TempestTools\Common\Utility;

trait ErrorConstantsTrait
{
    public function getErrorFromConstant (string $errorName): array
    {
        if (static::ERRORS === null) {
            throw new \RuntimeException('Error: ErrorConstantsTrait apply to a class with ERRORS constant');
        }

        if (!isset(static::ERRORS[$errorName])) {
            throw new \RuntimeException('Error: ErrorConstantsTrait was passed an error name that was not found in the ERRORS constant');
        }
        return static::ERRORS[$errorName];
    }
}
