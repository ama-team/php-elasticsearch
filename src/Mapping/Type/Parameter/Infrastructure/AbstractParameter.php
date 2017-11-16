<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure;

use AmaTeam\ElasticSearch\API\Mapping\Type\ParameterInterface;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class AbstractParameter implements ParameterInterface
{
    /**
     * @var AbstractParameter[]
     */
    protected static $registry = [];

    public function getFriendlyId(): string
    {
        return $this->getId();
    }

    /**
     * @inheritDoc
     */
    public function nullValueAllowed(): bool
    {
        return false;
    }

    public static function getInstance()
    {
        $className = get_called_class();
        if (!isset(static::$registry[$className])) {
            static::$registry[$className] = new static();
        }
        return static::$registry[$className];
    }
}
