<?php

namespace AmaTeam\ElasticSearch\Entity;

use AmaTeam\ElasticSearch\API\Entity\Normalization\Context;
use AmaTeam\ElasticSearch\API\Entity\Normalization\ContextInterface;
use AmaTeam\ElasticSearch\API\Indexing\Normalization\Context as IndexingContext;
use AmaTeam\ElasticSearch\API\Indexing\NormalizerInterface as IndexingNormalizerInterface;
use AmaTeam\ElasticSearch\API\IndexingInterface;
use AmaTeam\ElasticSearch\API\Mapping\Normalization\Context as MappingContext;
use AmaTeam\ElasticSearch\API\Mapping\NormalizerInterface as MappingNormalizerInterface;
use AmaTeam\ElasticSearch\API\Entity\NormalizerInterface;
use AmaTeam\ElasticSearch\API\EntityInterface;
use AmaTeam\ElasticSearch\API\MappingInterface;
use AmaTeam\ElasticSearch\Indexing\Normalizer as IndexingNormalizer;
use AmaTeam\ElasticSearch\Mapping\Normalizer as MappingNormalizer;

class Normalizer implements NormalizerInterface
{
    /**
     * @var IndexingNormalizerInterface
     */
    private $indexingNormalizer;
    /**
     * @var MappingNormalizerInterface
     */
    private $mappingNormalizer;

    public function __construct()
    {
        $this->indexingNormalizer = new IndexingNormalizer();
        $this->mappingNormalizer = new MappingNormalizer();
    }

    public function normalize(EntityInterface $entity, ContextInterface $context = null): EntityInterface
    {
        $context = $context ?? new Context();
        $entity = Operations::from($entity)
            ->setIndexing($this->normalizeIndexing($entity->getIndexing(), $context))
            ->setMapping($this->normalizeMapping($entity->getMapping(), $context));
        return $entity;
    }

    private function normalizeIndexing(IndexingInterface $indexing, ContextInterface $context): IndexingInterface
    {
        $configuration = (new IndexingContext())
            ->setPreserveUnknownOptions($context->shouldPreserveUnknownEntries())
            ->setPreservedOptions($context->getPreservedIndexingOptions());
        return $this->indexingNormalizer->normalize($indexing, $configuration);
    }

    private function normalizeMapping(MappingInterface $mapping, ContextInterface $context): MappingInterface
    {
        $configuration = (new MappingContext())
            ->setRootMapping(true)
            ->setPreserveUnknownParameters($context->shouldPreserveUnknownEntries())
            ->setPreservedParameters($context->getPreservedMappingParameters());
        return $this->mappingNormalizer->normalize($mapping, $configuration);
    }
}
