<?php

namespace TempestTools\Common\Doctrine\Transformers;

use TempestTools\Crud\Contracts\Orm\EntityContract;

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
     */
    public function convert(EntityContract $entity):array
    {
        $settings = $this->getSettings();
        $defaultMode = $settings['defaultMode'] ?? 'read';
        $defaultArrayHelper = $settings['defaultArrayHelper'] ?? null;
        $defaultPath = $settings['defaultPath'] ?? null;
        $defaultFallBack = $settings['defaultFallBack'] ?? null;
        $force = $settings['force'] ?? false;
        $frontEndOptions = $settings['frontEndOptions'] ?? [];

        return $entity->toArray($defaultMode, $defaultArrayHelper, $defaultPath, $defaultFallBack, $force, $frontEndOptions);
    }
}