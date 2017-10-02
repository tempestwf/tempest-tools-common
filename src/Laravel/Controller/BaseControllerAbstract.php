<?php

namespace TempestTools\Common\Laravel\Controller;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Event;
use TempestTools\Crud\Contracts\Controller\ControllerContract;
use TempestTools\Crud\Laravel\Controllers\RestfulControllerTrait;

abstract class BaseControllerAbstract extends Controller implements ControllerContract
{
    use /** @noinspection TraitsPropertiesConflictsInspection */ RestfulControllerTrait;

    /**
     * BaseControllerAbstract constructor.
     */
    public function __construct()
    {
        Event::subscribe($this);
    }

}