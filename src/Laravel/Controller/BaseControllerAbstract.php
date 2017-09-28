<?php

namespace TempestTools\Common\Laravel\Controller;



use Illuminate\Routing\Controller;
use TempestTools\Common\Contracts\HasArrayHelperContract;
use TempestTools\Common\Helper\ArrayHelperTrait;
use Illuminate\Support\Facades\Event;
use TempestTools\Common\Utility\TTConfigTrait;
use TempestTools\Crud\Contracts\HasPathAndFallBackContract;

abstract class BaseControllerAbstract extends Controller implements HasArrayHelperContract, HasPathAndFallBackContract
{
    use ArrayHelperTrait, TTConfigTrait;

    /**
     * BaseControllerAbstract constructor.
     */
    public function __construct()
    {
        Event::subscribe($this);
    }

}