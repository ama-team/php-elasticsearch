<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure;

use AmaTeam\ElasticSearch\API\Mapping\Type\ParameterInterface;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\AnalyzerParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\CoerceParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\CopyToParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DistanceErrorPctParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DocValuesParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DynamicParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\EagerGlobalOrdinalsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\EnabledParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\EnablePositionIncrementsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\FieldDataFrequencyFilterParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\FieldDataParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\FieldsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\FormatParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IgnoreAboveParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IgnoreMalformedParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexOptionsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\LocaleParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NormalizerParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NormsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NullValueParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\OrientationParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\PointsOnlyParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\PositionIncrementGapParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\PrecisionParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\PropertiesParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\RelationsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\ScalingFactorParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\SearchAnalyzerParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\SearchQuoteAnalyzerParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\SimilarityParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\SourceParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\StoreParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\StrategyParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\TermVectorParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\TreeLevelsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\TreeParameter;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Registry
{
    /**
     * @var ParameterInterface[]
     */
    private $idIndex = [];
    /**
     * @var ParameterInterface[]
     */
    private $friendlyIdIndex = [];

    public function register(ParameterInterface $parameter): Registry
    {
        $this->idIndex[$parameter->getId()] = $parameter;
        $this->friendlyIdIndex[$parameter->getFriendlyId()] = $parameter;
        return $this;
    }

    public function getAll()
    {
        return array_values($this->idIndex);
    }

    public function find(string $id): ?ParameterInterface
    {
        if (isset($this->idIndex[$id])) {
            return $this->idIndex[$id];
        }
        if (isset($this->friendlyIdIndex[$id])) {
            return $this->friendlyIdIndex[$id];
        }
        return null;
    }

    public function withDefaultParameters(): Registry
    {
        // TODO: use code generation
        /** @var ParameterInterface[] $parameters */
        $parameters = [
            AnalyzerParameter::getInstance(),
            CoerceParameter::getInstance(),
            CopyToParameter::getInstance(),
            DocValuesParameter::getInstance(),
            DynamicParameter::getInstance(),
            EagerGlobalOrdinalsParameter::getInstance(),
            EnabledParameter::getInstance(),
            EnablePositionIncrementsParameter::getInstance(),
            FieldDataFrequencyFilterParameter::getInstance(),
            FieldDataParameter::getInstance(),
            FieldsParameter::getInstance(),
            FormatParameter::getInstance(),
            IgnoreAboveParameter::getInstance(),
            IgnoreMalformedParameter::getInstance(),
            IndexOptionsParameter::getInstance(),
            IndexParameter::getInstance(),
            LocaleParameter::getInstance(),
            NormalizerParameter::getInstance(),
            NormsParameter::getInstance(),
            NullValueParameter::getInstance(),
            PositionIncrementGapParameter::getInstance(),
            PropertiesParameter::getInstance(),
            RelationsParameter::getInstance(),
            ScalingFactorParameter::getInstance(),
            SearchAnalyzerParameter::getInstance(),
            SearchQuoteAnalyzerParameter::getInstance(),
            SimilarityParameter::getInstance(),
            SourceParameter::getInstance(),
            StoreParameter::getInstance(),
            TermVectorParameter::getInstance(),
            DistanceErrorPctParameter::getInstance(),
            OrientationParameter::getInstance(),
            PointsOnlyParameter::getInstance(),
            PrecisionParameter::getInstance(),
            StrategyParameter::getInstance(),
            TreeParameter::getInstance(),
            TreeLevelsParameter::getInstance(),
        ];
        foreach ($parameters as $parameter) {
            $this->register($parameter);
        }
        return $this;
    }

    public static function createDefault(): Registry
    {
        return (new Registry())->withDefaultParameters();
    }

    private static $instance;

    public static function getInstance(): Registry
    {
        if (!isset(static::$instance)) {
            static::$instance = static::createDefault();
        }
        return static::$instance;
    }
}
