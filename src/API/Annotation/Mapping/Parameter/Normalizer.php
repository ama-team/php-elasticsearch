<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractStringParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NormalizerParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class Normalizer extends AbstractStringParameterAnnotation
{
    public function getParameter(): string
    {
        return NormalizerParameter::FRIENDLY_ID;
    }
}
