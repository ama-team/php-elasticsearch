<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IgnoreMalformedParameter;

class GeoPointType extends AbstractType
{
    const ID = 'geo_point';
    const FRIENDLY_ID = 'geoPoint';

    public function getId(): string
    {
        return self::ID;
    }

    public function getFriendlyId(): string
    {
        return self::FRIENDLY_ID;
    }

    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return [IgnoreMalformedParameter::getInstance()];
    }
}
