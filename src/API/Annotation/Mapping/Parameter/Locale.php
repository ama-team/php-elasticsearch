<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractStringParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\LocaleParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class Locale extends AbstractStringParameterAnnotation
{
    public function getParameter(): string
    {
        return LocaleParameter::FRIENDLY_ID;
    }
}
