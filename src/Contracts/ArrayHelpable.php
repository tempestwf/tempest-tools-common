<?php

namespace TempestTools\Common\Contracts;
use \TempestTools\Common\Contracts\ArrayHelper as ArrayHelperContract;

interface ArrayHelpable {

    public function extractSelf (): \ArrayObject;

    public function setArrayHelper(ArrayHelperContract $arrayHelper):ArrayHelpable;

    public function getArrayHelper():ArrayHelper;

    public function arrayHelper():ArrayHelper;


}
