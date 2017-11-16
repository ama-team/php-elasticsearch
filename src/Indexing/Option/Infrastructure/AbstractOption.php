<?php

namespace AmaTeam\ElasticSearch\Indexing\Option\Infrastructure;

use AmaTeam\ElasticSearch\API\Indexing\OptionInterface;

abstract class AbstractOption implements OptionInterface
{
    public function allowsNullValue(): bool
    {
        return false;
    }

    /**
     * @var AbstractOption[]
     */
    protected static $registry = [];

    /**
     * @return static
     */
    public static function getInstance()
    {
        $className = get_called_class();
        if (!isset(self::$registry[$className])) {
            self::$registry[$className] = new static();
        }
        return self::$registry[$className];
    }
}
