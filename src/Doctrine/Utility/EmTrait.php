<?php

namespace TempestTools\Common\Doctrine\Utility;

use Doctrine\ORM\EntityManager;

/**
 * A trait that lets a class get and set an entity manager
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
trait EmTrait
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param EntityManager $em
     */
    public function setEm(EntityManager $em): void
    {
        $this->em = $em;
    }

    /**
     * @return EntityManager
     */
    public function getEm(): ?EntityManager
    {
        return $this->em;
    }
}
