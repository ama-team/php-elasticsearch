<?php

namespace AmaTeam\ElasticSearch\Indexing\Analysis;

use AmaTeam\ElasticSearch\API\Indexing\Analysis;
use AmaTeam\ElasticSearch\API\Indexing\AnalysisInterface;

class Operations
{
    public static function merge(AnalysisInterface ...$sources): Analysis
    {
        $target = new Analysis();
        foreach ($sources as $source) {
            foreach ($source->getAnalyzers() as $name => $analyzer) {
                $target->setAnalyzer($name, $analyzer);
            }
            foreach ($source->getCharacterFilters() as $name => $characterFilter) {
                $target->setCharacterFilter($name, $characterFilter);
            }
            foreach ($source->getTokenizers() as $name => $tokenizer) {
                $target->setTokenizer($name, $tokenizer);
            }
            foreach ($source->getTokenFilters() as $name => $tokenFilter) {
                $target->setTokenFilter($name, $tokenFilter);
            }
        }
        return $target;
    }
}
