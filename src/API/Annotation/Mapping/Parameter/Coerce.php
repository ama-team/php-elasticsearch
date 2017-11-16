<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractBooleanParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\CoerceParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class Coerce extends AbstractBooleanParameterAnnotation
{
    public function getParameter(): string
    {
        return CoerceParameter::FRIENDLY_ID;
    }
}
