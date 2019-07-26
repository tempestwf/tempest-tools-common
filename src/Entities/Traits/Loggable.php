<?php

namespace TempestTools\Common\Entities\Traits;

/**
 * Loggable
 * Loggable behavior tracks your record changes and is able to manage versions.
 *
 * * Automatic storage of log entries in database
 * * Can be nested with other behaviors
 * * Objects can be reverted to previous versions
 * * Annotation, Yaml and Xml mapping support for extensions
 *
 * link: https://www.laraveldoctrine.org/docs/1.0/extensions/loggable
 */

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @Gedmo\Loggable
 */
trait Loggable
{
    /**
     * Add the following annotations (without the space) to the field you want to version
     *
     * @ Gedmo\Versioned
     * @ ORM\Column(name="title", type="string", length=8)
     */
    // protected $slug; <- selected field to version
}