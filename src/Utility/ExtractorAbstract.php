<?php

namespace TempestTools\Common\Utility;


use TempestTools\Common\Contracts\ExtractableContract;

/**
 * An abstract base class for child classes so they can extract data and normalize it into an array structure.
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
abstract class ExtractorAbstract implements ExtractableContract
{
    use ExtractorOptionsTrait;


    /**
     * Returns values array with a top level key. Used to get data that will be stored on a array helper array.
     * @return array
     */
    abstract public function extractValues() : array;


}
