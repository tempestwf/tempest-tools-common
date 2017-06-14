<?php

namespace TempestTools\Common\Contracts;


use Doctrine\Common\EventManager;

interface Evm
{

    public function setEvm(EventManager $evm): Evm;

    public function getEvm(): EventManager;
}