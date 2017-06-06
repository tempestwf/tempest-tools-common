<?php

namespace TempestTools\Common\Utility;

use TempestTools\Common\Contracts\Extractable;

trait ExtractorOptionsTrait
{
    /**
     * @var array $options
     */
    protected $extractorOptions = [];

    /**
     * @param array $options
     * @return Extractable|ExtractorOptionsTrait
     */
    public function setExtractorOptions(array $options) : Extractable
    {
        $this->extractorOptions = $options;
        return $this;
    }

    /**
     * @return array
     */
    public function getExtractorOptions(): array
    {
        return $this->extractorOptions;
    }

}
