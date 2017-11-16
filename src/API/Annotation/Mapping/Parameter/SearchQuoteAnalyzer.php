<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractStringParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\SearchQuoteAnalyzerParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class SearchQuoteAnalyzer extends AbstractStringParameterAnnotation
{
    public function getParameter(): string
    {
        return SearchQuoteAnalyzerParameter::FRIENDLY_ID;
    }
}
