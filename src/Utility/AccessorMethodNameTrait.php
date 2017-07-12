<?php

namespace TempestTools\Common\Utility;


trait AccessorMethodNameTrait
{

    /**
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
