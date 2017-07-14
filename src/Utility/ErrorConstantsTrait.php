<?php

namespace TempestTools\Common\Utility;

trait ErrorConstantsTrait
{
    public function getErrorFromConstant (string $errorName): array
    {
        if (static::ERRORS === null) {
            throw new \RuntimeException(sprintf('Error: ErrorConstantsTrait applied to a class with out an ERRORS constant. Class name = %s.', get_class($this)));
        }

        if (!isset(static::ERRORS[$errorName])) {
            throw new \RuntimeException(sprintf('Error: ErrorConstantsTrait was passed an error name that was not found in the ERRORS constant. Error name = %s.', $errorName));
        }
        return static::ERRORS[$errorName];
    }
}
