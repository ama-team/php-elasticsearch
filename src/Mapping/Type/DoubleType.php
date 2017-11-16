<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractNumericType;

class DoubleType extends AbstractNumericType
{
    const ID = 'double';
    const FRIENDLY_ID = self::ID;

    public function getId(): string
    {
        return self::ID;
    }
}
