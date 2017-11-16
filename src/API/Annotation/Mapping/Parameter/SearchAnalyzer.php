<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractStringParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\SearchAnalyzerParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class SearchAnalyzer extends AbstractStringParameterAnnotation
{
    public function getParameter(): string
    {
        return SearchAnalyzerParameter::FRIENDLY_ID;
    }
}
