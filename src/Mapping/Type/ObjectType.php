<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DynamicParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\EnabledParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\PropertiesParameter;

class ObjectType extends AbstractType
{
    const ID = 'object';
    const FRIENDLY_ID = self::ID;

    public function getId(): string
    {
        return self::ID;
    }

    public function getParameters(): array
    {
        return [
            DynamicParameter::getInstance(),
            EnabledParameter::getInstance(),
            PropertiesParameter::getInstance()
        ];
    }
}
