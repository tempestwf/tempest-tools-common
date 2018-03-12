<?php

namespace TempestTools\Common\Entities\Traits;

use Doctrine\ORM\Mapping AS ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity as SoftDeleteableEntityTraits;

trait SoftDeleteable
{
    use SoftDeleteableEntityTraits;
}