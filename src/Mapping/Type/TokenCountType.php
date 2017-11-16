<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\AnalyzerParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DocValuesParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\EnablePositionIncrementsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NullValueParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\StoreParameter;

class TokenCountType extends AbstractType
{
    const ID = 'token_count';
    const FRIENDLY_ID = 'tokenCount';

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
            AnalyzerParameter::getInstance(),
            EnablePositionIncrementsParameter::getInstance(),
            DocValuesParameter::getInstance(),
            IndexParameter::getInstance(),
            NullValueParameter::getInstance(),
            StoreParameter::getInstance(),
        ];
    }
}
