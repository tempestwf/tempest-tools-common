<?php

namespace TempestTools\Common\Utility;

trait AnnotatedTrait
{
    /**
     * Key value pairs stored here will be returned by the TempestTool exception handler.
     * @var array $annotations
     */
    protected $annotations = [];

    /**
     * @return array
     */
    public function getAnnotations(): array
    {
        return $this->annotations;
    }

    /**
     * @param array $annotations
     */
    public function setAnnotations(array $annotations)
    {
        $this->annotations = $annotations;
    }

    /**
     * returns a string to add to the end of an exception message
     * @return string
     */
    public function annotationsToString(): string
    {
        return 'Details: ' . http_build_query($this->getAnnotations());
    }
}
