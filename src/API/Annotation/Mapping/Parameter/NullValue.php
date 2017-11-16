<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NullValueParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class NullValue extends AbstractParameterAnnotation
{
    public function getParameter(): string
    {
        return NullValueParameter::FRIENDLY_ID;
    }
}
