<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 9/15/2017
 * Time: 3:51 PM
 */

namespace TempestTools\Common\Contracts\Doctrine\Transformers;

use Doctrine\Common\Collections\Collection;
use TempestTools\Crud\Contracts\Orm\EntityContract;

/**
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
interface SimpleTransformerContract
{

    /**
     * @param array $settings
     */
    public function __construct(array $settings = []);

    /**
     * @param EntityContract $entity
     * @return mixed
     */
    public function convert(EntityContract $entity);

    /**
     * @param EntityContract $entity
     * @return mixed
     */
    public function item (EntityContract $entity);

    /**
     * @param EntityContract $entity
     * @return bool
     */
    public function verifyItem(EntityContract $entity): bool;

    /**
     * @param Collection $collection
     * @return array
     */
    public function collection(Collection $collection): array;

    /**
     * @param array $array
     * @return array
     */
    public function array(array $array): array;

    /**
     * @param $subject
     * @return mixed
     */
    public function transform($subject);

    /**
     * @return array
     */
    public function getSettings():array;

    /**
     * @param array $settings
     * @return SimpleTransformerContract
     */
    public function setSettings(array $settings): SimpleTransformerContract;
}