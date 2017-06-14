<?php

namespace TempestTools\Common\Laravel\Controller;



use Illuminate\Routing\Controller;
use TempestTools\Common\Contracts\ArrayHelpable;
use TempestTools\Common\Helper\ArrayHelperTrait;

class BaseController extends Controller implements ArrayHelpable
{
    use ArrayHelperTrait;

}