<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractNumericType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\ScalingFactorParameter;

class ScaledFloatType extends AbstractNumericType
{
    const ID = 'scaled_float';
    const FRIENDLY_ID = 'scaledFloat';

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
        return array_merge(
            parent::getParameters(),
            [ScalingFactorParameter::getInstance()]
        );
    }
}
