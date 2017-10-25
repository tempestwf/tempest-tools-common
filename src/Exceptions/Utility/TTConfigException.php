<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 8/19/2017
 * Time: 6:52 PM
 */

namespace TempestTools\Common\Exceptions\Utility;

/**
 * Exception related tempest tools configurations
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
class TTConfigException extends \RunTimeException
{
    /**
     * @return TTConfigException
     */
    public static function noArrayHelperFound (): TTConfigException
    {
        return new self ('Error: No array helper on entity.');
    }

    /**
     * @param array $path
     * @param array $fallback
     * @return TTConfigException
     */
    public static function pathAndFallBackNotFound (array $path, array $fallback): TTConfigException
    {
        return new self (sprintf('Error: Path and fall back not found in config. path = %s, fall back = %s', json_encode($path), json_encode($fallback)));
    }

    /**
     * @param string $mode
     * @return TTConfigException
     */
    public static function modeNotRecognized (string $mode): TTConfigException
    {
        return new self (sprintf('Error: Mode selected for config is not supported. mode = %s', $mode));
    }

}



