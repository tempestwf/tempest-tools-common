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
        return $verb . ucfirst($property);
    }

}
