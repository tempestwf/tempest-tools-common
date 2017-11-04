<?php

namespace TempestTools\Common\Utility;


use Doctrine\Common\EventManager;

/**
 * A trait for adding convenience methods to a class so store and retrieve a Doctrine event manager
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
trait EvmTrait
{
    /** @var EventManager|null */
    protected $evm;

    /**
     * @param EventManager|null $evm
     */
    public function setEvm(EventManager $evm): void
    {
        $this->evm = $evm;
    }

    /**
     * @return EventManager|null
     */
    public function getEvm():?EventManager
    {
        return $this->evm;
    }

}
