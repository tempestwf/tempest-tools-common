<?php

namespace TempestTools\Common\Utility;

/**
 * A trait for setting and getting extractor options on a class.
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
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
