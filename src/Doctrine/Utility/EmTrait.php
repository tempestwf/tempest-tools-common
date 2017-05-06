<?php

namespace TempestTools\Doctrine\Utility;

use Doctrine\ORM\EntityManager;

trait EmTrait
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param EntityManager $em
     * @return EmTrait
     */
    public function setEm(EntityManager $em):EmTrait
    {
        $this->em = $em;
        return $this;
    }

    /**
     * @return EntityManager
     */
    public function getEm(): EntityManager
    {
        return $this->em;
    }
}
