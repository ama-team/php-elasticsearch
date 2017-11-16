<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DynamicParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\EnabledParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\PropertiesParameter;

class NestedType extends AbstractType
{
    const ID = 'nested';
    const FRIENDLY_ID = self::ID;

    public function getId(): string
    {
        return self::ID;
    }

    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return [
            EnabledParameter::getInstance(),
            DynamicParameter::getInstance(),
            PropertiesParameter::getInstance(),
        ];
    }
}
