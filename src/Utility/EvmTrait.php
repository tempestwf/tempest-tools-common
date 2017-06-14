<?php

namespace TempestTools\Common\Utility;


use Doctrine\Common\EventManager;
use TempestTools\Common\Contracts\Evm;

trait EvmTrait
{
    /** @var EventManager|null */
    protected $evm;

    /**
     * @param EventManager|null $evm
     * @return EvmTrait|Evm
     */
    public function setEvm(EventManager $evm):Evm
    {
        $this->evm = $evm;
        return $this;
    }

    /**
     * @return EventManager|null
     */
    public function getEvm():EventManager
    {
        return $this->evm;
    }

}
