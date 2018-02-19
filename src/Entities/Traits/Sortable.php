<?php

namespace TempestTools\Common\Entities\Traits;

/**
 * Sortable
 * Sortable behavior will maintain a position field for ordering entities.\
 *
 * * Automatic handling of position index
 * * Group entity ordering by one or more fields
 * * Can be nested with other behaviors
 * * Annotation, Yaml and Xml mapping support for extensions
 *
 * link: https://www.laraveldoctrine.org/docs/1.0/extensions/sortable
 */

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
trait Sortable
{
    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    /**
     * @Gedmo\SortableGroup
     * @ORM\Column(name="category", type="string", length=128)
     */
    protected $category;


    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param $category
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
}