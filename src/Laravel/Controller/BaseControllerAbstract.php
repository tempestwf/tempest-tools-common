<?php

namespace TempestTools\Common\Laravel\Controller;

use Illuminate\Routing\Controller;
use TempestTools\Common\Helper\ArrayHelperTrait;
use Illuminate\Support\Facades\Event;
use TempestTools\Common\Utility\TTConfigTrait;
use TempestTools\Crud\Contracts\Controller\ControllerContract;
use TempestTools\Crud\Laravel\Controllers\RestfulControllerTrait;

abstract class BaseControllerAbstract extends Controller implements ControllerContract
{
    use ArrayHelperTrait, TTConfigTrait, /** @noinspection TraitsPropertiesConflictsInspection */ RestfulControllerTrait;

    /**
     * BaseControllerAbstract constructor.
     */
    public function __construct()
    {
        Event::subscribe($this);
    }

}