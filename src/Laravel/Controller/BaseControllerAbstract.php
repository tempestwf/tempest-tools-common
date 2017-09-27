<?php

namespace TempestTools\Common\Laravel\Controller;



use Illuminate\Routing\Controller;
use TempestTools\Common\Contracts\HasArrayHelperContract;
use TempestTools\Common\Helper\ArrayHelperTrait;
use Illuminate\Support\Facades\Event;

abstract class BaseControllerAbstract extends Controller implements HasArrayHelperContract
{
    use ArrayHelperTrait;

    /**
     * BaseControllerAbstract constructor.
     */
    public function __construct()
    {
        Event::subscribe($this);
    }

}