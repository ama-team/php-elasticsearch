<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractIntegerParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IgnoreAboveParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class IgnoreAbove extends AbstractIntegerParameterAnnotation
{
    public function getParameter(): string
    {
        return IgnoreAboveParameter::FRIENDLY_ID;
    }
}
