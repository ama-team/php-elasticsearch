<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractBooleanParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DocValuesParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class DocValues extends AbstractBooleanParameterAnnotation
{
    public function getParameter(): string
    {
        return DocValuesParameter::FRIENDLY_ID;
    }
}
