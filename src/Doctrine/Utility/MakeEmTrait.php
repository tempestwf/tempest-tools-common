<?php

namespace TempestTools\Common\Doctrine\Utility;

use Doctrine\ORM\EntityManager;

trait MakeEmTrait
{
    use EmTrait;
    /**
     * @var string
     */
    protected $entityManagerClass = EntityManager::class;

    /**
     * returns or makes the em then returns it
     * @return EntityManager
     */
    public function em(): EntityManager
    {
        return $this->getEm() ?? $this->makeEm();
    }
    /**
     * Makes the entity manager and saves it on the class then returns it.
     * @return EntityManager
     */
    protected function makeEm(): EntityManager
    {
        $em = \App::make($this->getEntityManagerClass());
        $this->setEm($em);
        return $this->getEm();
    }

    /**
     * @param string $entityManagerClass
     * @return MakeEmTrait
     */
    public function setEntityManagerClass(string $entityManagerClass)
    {
        $this->entityManagerClass = $entityManagerClass;
        return $this;
    }

    /**
     * @return string
     */
    public function getEntityManagerClass(): string
    {
        return $this->entityManagerClass;
    }


}
