<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractBooleanParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\EnabledParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class Enabled extends AbstractBooleanParameterAnnotation
{
    /**
     * @var bool
     */
    public $value;

    public function getParameter(): string
    {
        return EnabledParameter::FRIENDLY_ID;
    }
}
