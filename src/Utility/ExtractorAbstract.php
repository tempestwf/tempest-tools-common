<?php

namespace TempestTools\Common\Utility;


use TempestTools\Common\Contracts\ExtractableContract;

abstract class ExtractorAbstract implements ExtractableContract
{
    use ExtractorOptionsTrait;


    /**
     * Returns values array with a top level key. Used to get data that will be stored on a array helper array.
     * @return array
     */
    public function extractValues() : array
    {
      return [];
    }


}
