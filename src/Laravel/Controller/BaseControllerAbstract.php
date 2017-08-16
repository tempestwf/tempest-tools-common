<?php

namespace TempestTools\Common\Laravel\Controller;



use Illuminate\Routing\Controller;
use TempestTools\Common\Helper\ArrayHelperTrait;

abstract class BaseControllerAbstract extends Controller
{
    use ArrayHelperTrait;

}