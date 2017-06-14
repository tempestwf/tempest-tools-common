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
    public function setExtractorOptions(array $options)
    {
        $this->extractorOptions = $options;
    }

    /**
     * @return array
     */
    public function getExtractorOptions(): array
    {
        return $this->extractorOptions;
    }

}
