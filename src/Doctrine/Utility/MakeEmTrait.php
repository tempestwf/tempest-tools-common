<?php

namespace TempestTools\Common\Doctrine\Utility;

use Doctrine\ORM\EntityManager;

/**
 * A trait that adds an entity manager to a class
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
trait MakeEmTrait
{
    use EmTrait;
    /**
     * @var string
     */
    protected $entityManagerClass = EntityManager::class;

    /**
     * Returns or makes the em then returns it
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
     */
    public function setEntityManagerClass(string $entityManagerClass): void
    {
        $this->entityManagerClass = $entityManagerClass;
    }

    /**
     * @return string
     */
    public function getEntityManagerClass(): string
    {
        return $this->entityManagerClass;
    }


}
