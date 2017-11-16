<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DocValuesParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\FormatParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IgnoreMalformedParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\LocaleParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NullValueParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\StoreParameter;

class DateType extends AbstractType
{
    const ID = 'date';
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
            FormatParameter::getInstance(),
            LocaleParameter::getInstance(),
            IgnoreMalformedParameter::getInstance(),
            IndexParameter::getInstance(),
            NullValueParameter::getInstance(),
            StoreParameter::getInstance(),
        ];
    }
}
