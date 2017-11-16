<?php

namespace AmaTeam\ElasticSearch\Indexing;

use AmaTeam\ElasticSearch\API\Indexing;
use AmaTeam\ElasticSearch\API\Indexing\Analysis;
use AmaTeam\ElasticSearch\API\IndexingInterface;
use AmaTeam\ElasticSearch\Indexing\Analysis\Operations as AnalysisOperations;

class Operations
{
    public static function toMutable(IndexingInterface $indexing): Indexing
    {
        if ($indexing instanceof Indexing) {
            return $indexing;
        }
        return static::from($indexing);
    }

    public static function from(IndexingInterface $source): Indexing
    {
        return static::merge($source);
    }

    public static function merge(IndexingInterface ...$indexings): Indexing
    {
        $analysis = new Analysis();
        $target = (new Indexing())->setAnalysis($analysis);
        foreach ($indexings as $source) {
            $target->setType($source->getType());
            if (!empty($source->getReadIndices())) {
                $target->setReadIndices($source->getReadIndices());
            }
            if (!empty($source->getWriteIndices())) {
                $target->setWriteIndices($source->getWriteIndices());
            }
            foreach ($source->getOptions() as $option => $value) {
                $target->setOption($option, $value);
            }
            $analysis = AnalysisOperations::merge($target->getAnalysis(), $source->getAnalysis());
            $target->setAnalysis($analysis);
        }
        return $target;
    }
}
