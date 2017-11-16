<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DocValuesParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NullValueParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\StoreParameter;

class BooleanType extends AbstractType
{
    const ID = 'boolean';
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
            DocValuesParameter::getInstance(),
            IndexParameter::getInstance(),
            NullValueParameter::getInstance(),
            StoreParameter::getInstance()
        ];
    }
}
