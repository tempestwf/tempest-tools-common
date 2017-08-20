<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 8/19/2017
 * Time: 6:52 PM
 */

namespace TempestTools\Common\Exceptions;


class TTConfigException extends \RunTimeException
{
    /**
     * @return TTConfigException
     */
    public static function stringPathDoesNotStartWith (): TTConfigException
    {
        return new self ('Error: No array helper on entity.');
    }



}



