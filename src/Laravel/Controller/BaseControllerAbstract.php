<?php

namespace TempestTools\Common\Laravel\Controller;



use Illuminate\Routing\Controller;
use TempestTools\Common\Helper\ArrayHelperTrait;
use Illuminate\Support\Facades\Event;

abstract class BaseControllerAbstract extends Controller
{
    use ArrayHelperTrait;

    public function __construct()
    {
        Event::subscribe($this);
    }

}