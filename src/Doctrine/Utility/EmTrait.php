<?php

namespace TempestTools\Common\Doctrine\Utility;

use Doctrine\ORM\EntityManager;

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
