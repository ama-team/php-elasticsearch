<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractStringParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\CopyToParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class CopyTo extends AbstractStringParameterAnnotation
{
    public function getParameter(): string
    {
        return CopyToParameter::FRIENDLY_ID;
    }
}
