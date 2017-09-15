<?php

use TempestTools\Crud\Contracts\Orm\EntityContract;
use TempestTools\Common\Doctrine\Transformers\SimpleTransformerAbstract;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 9/15/2017
 * Time: 3:52 PM
 */

class ToArrayTransformer extends SimpleTransformerAbstract {

    /**
     * @param EntityContract $entity
     * @return array
     * @throws \RuntimeException
     */
    public function convert(EntityContract $entity):array
    {
        return $entity->toArray();
    }
}