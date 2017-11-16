<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractBooleanParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\FieldDataParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class FieldData extends AbstractBooleanParameterAnnotation
{
    public function getParameter(): string
    {
        return FieldDataParameter::FRIENDLY_ID;
    }
}
