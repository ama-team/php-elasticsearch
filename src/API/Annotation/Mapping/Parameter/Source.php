<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractBooleanParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\SourceParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class Source extends AbstractBooleanParameterAnnotation
{
    public function getParameter(): string
    {
        return SourceParameter::FRIENDLY_ID;
    }
}
