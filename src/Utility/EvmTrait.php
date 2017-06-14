<?php

namespace TempestTools\Common\Utility;


use Doctrine\Common\EventManager;

trait EvmTrait
{
    /** @var EventManager|null */
    protected $evm;

    /**
     * @param EventManager|null $evm
     */
    public function setEvm(EventManager $evm)
    {
        $this->evm = $evm;
    }

    /**
     * @return EventManager|null
     */
    public function getEvm():EventManager
    {
        return $this->evm;
    }

}
