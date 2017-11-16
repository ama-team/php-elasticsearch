<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DynamicParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class Dynamic extends AbstractParameterAnnotation
{
    /**
     * @Enum({true, false, "true", "false", "strict"})
     */
    public $value;

    public function getParameter(): string
    {
        return DynamicParameter::FRIENDLY_ID;
    }
}
