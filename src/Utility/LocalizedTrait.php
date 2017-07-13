<?php

namespace TempestTools\Common\Utility;

trait LocalizedTrait
{
    /**
     * Whether or not to localize the message on the exception
     * @var bool $localize
     */
    protected $localize = true;

    /**
     * @return bool
     */
    public function isLocalize(): bool
    {
        return $this->localize;
    }
}
