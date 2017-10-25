<?php

namespace TempestTools\Common\Laravel\Controller;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Event;
use TempestTools\Common\Contracts\HasArrayHelperContract;
use TempestTools\Crud\Contracts\Controller\ControllerContract;
use TempestTools\Crud\Laravel\Controllers\RestfulControllerTrait;

/**
 * A base controller class for Tempest Tools controllers
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
abstract class BaseControllerAbstract extends Controller implements ControllerContract, HasArrayHelperContract
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