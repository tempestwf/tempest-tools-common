<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 3/31/2018
 * Time: 4:14 PM
 */

namespace TempestTools\Common\Doctrine\Generator;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;

/**
 * Class UniqueIdGenerator. Generates uniques random unique ids.
 *
 * @package TempestTools\Common\Doctrine\Generator
 */
class SecureUniqueIdGenerator extends AbstractIdGenerator
{
    public function generate(EntityManager $em, $entity): string
    {
        return random_bytes(16);
    }
}