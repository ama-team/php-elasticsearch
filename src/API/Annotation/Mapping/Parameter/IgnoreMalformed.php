<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractBooleanParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IgnoreMalformedParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class IgnoreMalformed extends AbstractBooleanParameterAnnotation
{
    public function getParameter(): string
    {
        return IgnoreMalformedParameter::FRIENDLY_ID;
    }
}
