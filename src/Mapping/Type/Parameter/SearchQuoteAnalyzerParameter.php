<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractStringParameter;

class SearchQuoteAnalyzerParameter extends AbstractStringParameter
{
    const ID = 'search_quote_analyzer';
    const FRIENDLY_ID = 'searchQuoteAnalyzer';

    public function getId(): string
    {
        return self::ID;
    }

    public function getFriendlyId(): string
    {
        return self::FRIENDLY_ID;
    }
}
