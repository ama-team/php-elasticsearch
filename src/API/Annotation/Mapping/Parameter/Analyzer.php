<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractStringParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\AnalyzerParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class Analyzer extends AbstractStringParameterAnnotation
{
    public function getParameter(): string
    {
        return AnalyzerParameter::FRIENDLY_ID;
    }
}
