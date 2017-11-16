<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Infrastructure;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\CoerceParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\StoreParameter;

abstract class AbstractRangeType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return [
            IndexParameter::getInstance(),
            StoreParameter::getInstance(),
            CoerceParameter::getInstance(),
        ];
    }
}
