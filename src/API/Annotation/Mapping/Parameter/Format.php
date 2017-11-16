<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractStringParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\FormatParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class Format extends AbstractStringParameterAnnotation
{
    public function getParameter(): string
    {
        return FormatParameter::FRIENDLY_ID;
    }
}
