<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DocValuesParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\EagerGlobalOrdinalsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\FieldsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IgnoreAboveParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexOptionsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NormalizerParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NormsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NullValueParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\SimilarityParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\StoreParameter;

class KeywordType extends AbstractType
{
    const ID = 'keyword';
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
            EagerGlobalOrdinalsParameter::getInstance(),
            FieldsParameter::getInstance(),
            IgnoreAboveParameter::getInstance(),
            IndexParameter::getInstance(),
            IndexOptionsParameter::getInstance(),
            NormsParameter::getInstance(),
            NullValueParameter::getInstance(),
            StoreParameter::getInstance(),
            SimilarityParameter::getInstance(),
            NormalizerParameter::getInstance(),
        ];
    }
}
