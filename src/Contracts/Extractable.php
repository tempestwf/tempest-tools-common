<?php

namespace TempestTools\Common\Contracts;

interface Extractable
{

    /**
     * Returns values array with a top level key. Used to get data that will be stored on a array helper array.
     * @return array
     */
    public function extractValues() : array;

    /**
     * setter
     * @param array $options
     * @return Extractable
     */
    public function setExtractorOptions(array $options) : Extractable;

    /**
     * getter
     * @return array
     */
    public function getExtractorOptions():array;

}
