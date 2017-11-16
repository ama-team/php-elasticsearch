<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\AnalyzerParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\EagerGlobalOrdinalsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\FieldDataFrequencyFilterParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\FieldDataParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\FieldsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexOptionsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NormsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\PositionIncrementGapParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\SearchAnalyzerParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\SearchQuoteAnalyzerParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\SimilarityParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\StoreParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\TermVectorParameter;

class TextType extends AbstractType
{
    const ID = 'text';
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
            AnalyzerParameter::getInstance(),
            EagerGlobalOrdinalsParameter::getInstance(),
            FieldDataParameter::getInstance(),
            FieldDataFrequencyFilterParameter::getInstance(),
            FieldsParameter::getInstance(),
            IndexParameter::getInstance(),
            IndexOptionsParameter::getInstance(),
            NormsParameter::getInstance(),
            PositionIncrementGapParameter::getInstance(),
            StoreParameter::getInstance(),
            SearchAnalyzerParameter::getInstance(),
            SearchQuoteAnalyzerParameter::getInstance(),
            SimilarityParameter::getInstance(),
            TermVectorParameter::getInstance(),
        ];
    }
}
