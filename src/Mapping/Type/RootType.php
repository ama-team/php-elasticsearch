<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DynamicParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\EnabledParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\PropertiesParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\SourceParameter;

class RootType extends AbstractType
{
    const ID = 'root';
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
            SourceParameter::getInstance(),
            DynamicParameter::getInstance(),
            EnabledParameter::getInstance(),
            PropertiesParameter::getInstance()
        ];
    }
}
