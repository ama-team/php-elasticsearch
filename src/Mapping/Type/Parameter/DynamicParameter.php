<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractEnumParameter;

class DynamicParameter extends AbstractEnumParameter
{
    const ID = 'dynamic';
    const FRIENDLY_ID = self::ID;

    const VALUE_TRUE = 'true';
    const VALUE_FALSE = 'false';
    const VALUE_STRICT = 'strict';

    public function getId(): string
    {
        return self::ID;
    }

    public function getAllowedValues()
    {
        return [
            true,
            false,
            self::VALUE_TRUE,
            self::VALUE_FALSE,
            self::VALUE_STRICT
        ];
    }
}
