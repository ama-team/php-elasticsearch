<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Infrastructure;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\CoerceParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DocValuesParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IgnoreMalformedParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NullValueParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\StoreParameter;

abstract class AbstractNumericType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return [
            CoerceParameter::getInstance(),
            DocValuesParameter::getInstance(),
            IgnoreMalformedParameter::getInstance(),
            IndexParameter::getInstance(),
            NullValueParameter::getInstance(),
            StoreParameter::getInstance(),
        ];
    }
}
