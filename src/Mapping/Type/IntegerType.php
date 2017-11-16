<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractNumericType;

class IntegerType extends AbstractNumericType
{
    const ID = 'integer';
    const FRIENDLY_ID = self::ID;

    public function getId(): string
    {
        return self::ID;
    }
}
