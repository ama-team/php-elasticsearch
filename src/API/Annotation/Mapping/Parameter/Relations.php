<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\RelationsParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class Relations extends AbstractParameterAnnotation
{
    public function getParameter(): string
    {
        return RelationsParameter::FRIENDLY_ID;
    }
}
