<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractIntegerParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\ScalingFactorParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class ScalingFactor extends AbstractIntegerParameterAnnotation
{
    public function getParameter(): string
    {
        return ScalingFactorParameter::FRIENDLY_ID;
    }
}
