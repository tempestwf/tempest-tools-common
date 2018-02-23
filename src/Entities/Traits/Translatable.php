<?php

namespace TempestTools\Common\Entities\Traits;

/**
 * Translatable
 * Translatable behavior offers a very handy solution for translating specific record fields in different languages. Further more, it loads the translations automatically for a locale currently used, which can be set to Translatable Listener on it`s initialization or later for other cases through the Entity itself
 *
 * Automatic storage of translations in database
 * Automatic translation of Entity or Document fields then loaded
 * ORM query can use hint to translate all records without issuing additional queries
 * Can be nested with other behaviors
 * Annotation, Yaml and Xml mapping support for extensions
 *
 * link : https://www.laraveldoctrine.org/docs/1.0/extensions/translatable
 */

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
trait Translatable
{
    /**
     * Add the following annotations (without the space) to the field you want to be translatable
     *
     * @ Gedmo\Translatable
     * @ ORM\Column(name="content", type="text")
     */
    // protected $content;
}