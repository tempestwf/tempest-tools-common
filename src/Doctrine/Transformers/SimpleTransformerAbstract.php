<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 9/15/2017
 * Time: 3:15 PM
 */

namespace TempestTools\Common\Doctrine\Transformers;


use Doctrine\Common\Collections\Collection;
use Exception;
use TempestTools\Common\Contracts\Doctrine\Transformers\SimpleTransformerContract;
use TempestTools\Crud\Contracts\Orm\EntityContract;
use Doctrine\Common\Proxy\Proxy;


/**
 * An abstract class for making simple transformers.
 *
 * @link    https://github.com/tempestwf
 * @author  William Tempest Wright Ferrer <https://github.com/tempestwf>
 */
abstract class SimpleTransformerAbstract implements SimpleTransformerContract
{
    /**
     * @var array
     */
    protected $settings = [];

    /**
     * Transforms an entity
     * @param EntityContract $entity
     * @return mixed
     */
    abstract public function convert (EntityContract $entity);

    /**
     * @param array $settings
     */
    public function __construct(array $settings = [])
    {
        $this->setSettings($settings);
    }

    /**
     * Transforms a single item
     * @param EntityContract $entity
     * @return mixed
     */
    public function item (EntityContract $entity)
    {
        if ($this->verifyItem($entity) === true) {
            return $this->convert($entity);
        }
        return null;
    }

    /**
     * Verifies that an entity is ok to convert. It also lazy loads as needed
     * @param EntityContract $entity
     * @param array|null $extra
     * @return bool
     */
    public function verifyItem(EntityContract $entity, array $extra = null): bool
    {
        if($entity instanceof Proxy)
        {
            try
            {
                if($entity->__isInitialized() === true)
                {
                    $entity->__load();
                }
            } catch(Exception $ex)
            {
                return false;
            }
        }

        return true;
    }

    /**
     * Transforms a collection
     * @param Collection $collection
     * @return array
     */
    public function collection (Collection $collection):array
    {
        $return = [];
        foreach ($collection as $entity) {
            $return[] = $this->item($entity);
        }
        return $return;
    }

    /**
     * Transforms an array
     * @param array $array
     * @return array
     * @internal param Collection $collection
     */
    public function array (array $array):array
    {
        $return = [];
        foreach ($array as $entity) {
            $return[] = $this->item($entity);
        }
        return $return;
    }

    /**
     * Transforms an entity or collection
     * @param $subject
     * @return mixed
     */
    public function transform ($subject)
    {
        if (is_array($subject)) {
            return $this->array($subject);
        }

        if ($subject instanceof EntityContract) {
            return $this->item($subject);
        }

        if ($subject instanceof Collection) {
            return $this->collection($subject);
        }
        return null;
    }

    /**
     * @param array $settings
     * @return SimpleTransformerContract
     */
    public function setSettings(array $settings): SimpleTransformerContract
    {
        $this->settings = $settings;
        return $this;
    }

    /**
     * @return array
     */
    public function getSettings(): array
    {
        return $this->settings;
    }


}