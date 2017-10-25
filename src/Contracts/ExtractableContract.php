<?php

namespace TempestTools\Common\Contracts;

/**
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
interface ExtractableContract
{

    /**
     * Returns values array with a top level key. Used to get data that will be stored on a array helper array.
     * @return array
     */
    public function extractValues() : array;

    /**
     * setter
     * @param array $options
     */
    public function setExtractorOptions(array $options);

    /**
     * getter
     * @return array
     */
    public function getExtractorOptions():?array;

}
