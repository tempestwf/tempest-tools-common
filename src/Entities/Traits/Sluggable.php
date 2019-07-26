<?php

namespace TempestTools\Common\Entities\Traits;

/**
 * Sluggable
 * Sluggable behavior will build the slug of predefined fields on a given field which should store the slug

 * * Automatic predefined field transformation into slug
 * * Slugs can be unique and styled, even with prefixes and/or suffixes
 * * Can be nested with other behaviors
 * * Annotation, Yaml and Xml mapping support for extensions
 * * Multiple slugs, different slugs can link to same fields
 *
 * link: https://www.laraveldoctrine.org/docs/1.0/extensions/sluggable
 */

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
trait Sluggable
{
    /**
     * Add the following annotations (without the space) to the field you want to be slugged
     *
     * @ Gedmo\Slug(fields={"name", "surname"})
     * @ ORM\Column(length=128, unique=true)
     */
    // protected $slug;
}