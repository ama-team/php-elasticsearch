<?php

namespace AmaTeam\ElasticSearch\Indexing;

use AmaTeam\ElasticSearch\API\Indexing;
use AmaTeam\ElasticSearch\API\Indexing\AnalysisInterface;
use AmaTeam\ElasticSearch\API\Indexing\Normalization\Context;
use AmaTeam\ElasticSearch\API\Indexing\Normalization\ContextInterface;
use AmaTeam\ElasticSearch\API\Indexing\NormalizerInterface;
use AmaTeam\ElasticSearch\API\IndexingInterface;
use AmaTeam\ElasticSearch\Indexing\Option\Infrastructure\Registry;

class Normalizer implements NormalizerInterface
{
    /**
     * @var Registry
     */
    private $optionRegistry;

    /**
     * @param Registry $optionRegistry
     */
    public function __construct(Registry $optionRegistry = null)
    {
        $this->optionRegistry = $optionRegistry ?? Registry::getInstance();
    }

    public function normalize(IndexingInterface $indexing, ContextInterface $context = null): IndexingInterface
    {
        $context = $context ?? new Context();
        return (new Indexing())
            ->setType($indexing->getType())
            ->setWriteIndices(array_unique($indexing->getWriteIndices()))
            ->setReadIndices(array_unique($indexing->getReadIndices()))
            ->setAnalysis($this->normalizeAnalysis($indexing->getAnalysis(), $context))
            ->setOptions($this->normalizeOptions($indexing->getOptions(), $context));
    }

    private function normalizeAnalysis(AnalysisInterface $analysis, ContextInterface $context): AnalysisInterface
    {
        // TODO
        // silencing complexity analyser
        return $context ? $analysis : $analysis;
    }

    private function normalizeOptions(array $options, ContextInterface $context): array
    {
        $result = [];
        foreach ($options as $name => $value) {
            $option = $this->optionRegistry->find($name);
            if ($option) {
                if ($value !== null || $option->allowsNullValue()) {
                    $result[$option->getId()] = $value;
                }
                continue;
            }
            if ($context->shouldPreserveUnknownOptions() || in_array($name, $context->getPreservedOptions())) {
                $result[$name] = $value;
            }
        }
        return $result;
    }
}
