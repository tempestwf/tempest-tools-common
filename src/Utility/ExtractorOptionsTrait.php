<?php

namespace TempestTools\Common\Utility;

trait ExtractorOptionsTrait
{
    /**
     * @var array $options
     */
    protected $extractorOptions = [];

    /**
     * @param array $options
     */
    public function setExtractorOptions(array $options): void
    {
        $this->extractorOptions = $options;
    }

    /**
     * @return array
     */
    public function getExtractorOptions(): ?array
    {
        return $this->extractorOptions;
    }

}
