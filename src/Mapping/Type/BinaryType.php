<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DocValuesParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\StoreParameter;

class BinaryType extends AbstractType
{
    const ID = 'binary';
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
            StoreParameter::getInstance()
        ];
    }
}
