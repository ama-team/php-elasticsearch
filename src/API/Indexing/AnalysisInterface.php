<?php

namespace AmaTeam\ElasticSearch\API\Indexing;

use AmaTeam\ElasticSearch\API\Indexing\Analysis\AnalyzerInterface;
use AmaTeam\ElasticSearch\API\Indexing\Analysis\CharacterFilterInterface;
use AmaTeam\ElasticSearch\API\Indexing\Analysis\TokenFilterInterface;
use AmaTeam\ElasticSearch\API\Indexing\Analysis\TokenizerInterface;

interface AnalysisInterface
{
    /**
     * @return AnalyzerInterface[]
     */
    public function getAnalyzers(): array;

    /**
     * @return TokenizerInterface[]
     */
    public function getTokenizers(): array;

    /**
     * @return TokenFilterInterface[]
     */
    public function getTokenFilters(): array;

    /**
     * @return CharacterFilterInterface[]
     */
    public function getCharacterFilters(): array;
}
