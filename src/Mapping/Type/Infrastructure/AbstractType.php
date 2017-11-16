<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Infrastructure;

use AmaTeam\ElasticSearch\API\Mapping\TypeInterface;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class AbstractType implements TypeInterface
{
    /**
     * @var AbstractType[]
     */
    protected static $registry = [];

    public function getFriendlyId(): string
    {
        return $this->getId();
    }

    public static function getInstance()
    {
        $class = get_called_class();
        if (!isset(self::$registry[$class])) {
            self::$registry[$class] = new static();
        }
        return self::$registry[$class];
    }
}
