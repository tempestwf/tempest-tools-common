<?php

namespace TempestTools\Common\Utility;


/**
 * A trait that provides a method for converting a property name into it's corresponding accessor method names.
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
trait AccessorMethodNameTrait
{

    /**
     * A method for converting a property name into it's corresponding accessor method names.
     * @param string $verb
     * @param string $property
     * @return string
     */
    public function accessorMethodName(string $verb, string $property): string
    {
        $endsWithSinglePattern = '/Single$/';
        $endsWithSPattern = '/s$/';
        if (preg_match($endsWithSinglePattern, $verb)) {
            $verb = preg_replace($endsWithSinglePattern, '', $verb);
            $property = preg_replace($endsWithSPattern, '', $property);
        }

        return $verb . ucfirst($property);
    }


}
