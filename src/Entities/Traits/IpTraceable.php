<?php

namespace TempestTools\Common\Entities\Traits;

/**
 * IpTraceable
 * IpTraceable behavior will automate the update of IP trace on your Entities or Documents. It works through annotations and can update fields on creation, update, property subset update, or even on specific property value change.
 *
 * * Automatic predefined ip field update on creation, update, property subset update, and even on record property changes
 * * Specific annotations for properties, and no interface required
 * * Can react to specific property or relation changes to specific value
 * * Can be nested with other behaviors
 * * Annotation, Yaml and Xml mapping support for extensions
 *
 * link: https://www.laraveldoctrine.org/docs/1.0/extensions/iptraceable
 */

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\IpTraceable\Traits\IpTraceableEntity as IpTraceableEntityTraits;

/**
 * @ORM\Entity
 */
trait IpTraceable
{
    use IpTraceableEntityTraits;
}