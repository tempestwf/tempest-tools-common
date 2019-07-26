<?php

namespace TempestTools\Common\Entities\Traits;

/**
 * Blameable
 * Blameable behavior will automate the update of username or user reference fields on your Entities or Documents. It works through annotations and can update fields on creation, update, property subset update, or even on specific property value change.
 *
 * * Automatic predefined user field update on creation, update, property subset update, and even on record property changes
 * * Specific annotations for properties, and no interface required
 * * Can react to specific property or relation changes to specific value
 * * Can be nested with other behaviors
 * * Annotation, Yaml and Xml mapping support for extensions
 *
 * link: https://www.laraveldoctrine.org/docs/1.0/extensions/blameable
 */

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\BlameableEntity as BlameableEntityTraits;

/**
 * @ORM\Entity
 */
trait Blameable
{
    use BlameableEntityTraits;
}