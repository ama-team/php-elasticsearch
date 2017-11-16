<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractIntegerParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\PositionIncrementGapParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class PositionIncrementGap extends AbstractIntegerParameterAnnotation
{
    public function getParameter(): string
    {
        return PositionIncrementGapParameter::FRIENDLY_ID;
    }
}
