<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractFloatParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\FieldDataFrequencyFilterParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class FieldDataFrequencyFilter extends AbstractFloatParameterAnnotation
{
    public function getParameter(): string
    {
        return FieldDataFrequencyFilterParameter::FRIENDLY_ID;
    }
}
