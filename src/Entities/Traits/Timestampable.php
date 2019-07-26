<?php

namespace TempestTools\Common\Entities\Traits;

/**
 * Timestamps
 * Timestamps allows you to automatically record the time of certain events against your entities. This can be used to provide similar behaviour to the timestamps feature in Laravel's Eloquent ORM.
 *
 * * Automatic predefined date field update on creation, update, property subset update, and even on record property changes
 * * Specific annotations for properties, and no interface required
 * * Can react to specific property or relation changes to specific value
 * * Can be nested with other behaviors
 * * Annotation, Yaml and Xml mapping support for extensions
 *
 * link: https://www.laraveldoctrine.org/docs/1.0/extensions/timestamps
 */

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity as TimestampableEntityTraits;

/**
 * @ORM\Entity
 */
trait Timestampable
{

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * Sets createdAt.
     *
     * @param  \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Returns createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets updatedAt.
     *
     * @param  \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Returns updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}