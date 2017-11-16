<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DistanceErrorPctParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\OrientationParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\PointsOnlyParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\PrecisionParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\StrategyParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\TreeLevelsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\TreeParameter;

class GeoShapeType extends AbstractType
{
    const ID = 'geo_shape';
    const FRIENDLY_ID = 'geoShape';

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
            TreeParameter::getInstance(),
            PrecisionParameter::getInstance(),
            TreeLevelsParameter::getInstance(),
            StrategyParameter::getInstance(),
            DistanceErrorPctParameter::getInstance(),
            OrientationParameter::getInstance(),
            PointsOnlyParameter::getInstance()
        ];
    }
}
