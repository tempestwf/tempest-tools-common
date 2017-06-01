<?php

namespace TempestTools\Common\Utility;


use TempestTools\Common\Contracts\Extractable;

abstract class ExtractorAbstract implements Extractable
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
