<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractBooleanParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NormsParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class Norms extends AbstractBooleanParameterAnnotation
{
    public function getParameter(): string
    {
        return NormsParameter::FRIENDLY_ID;
    }
}
