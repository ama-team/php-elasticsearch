<?php

namespace AmaTeam\ElasticSearch\API\Entity;

use AmaTeam\ElasticSearch\API\Entity\Mapping\Structure\Mapping;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Structure\MappingInterface;
use AmaTeam\ElasticSearch\API\Indexing;
use AmaTeam\ElasticSearch\API\IndexingInterface;

/**
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
class Descriptor implements DescriptorInterface
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string[]
     */
    private $parentNames;
    /**
     * @var \AmaTeam\ElasticSearch\API\MappingInterface
     */
    private $mapping;
    /**
     * @var IndexingInterface
     */
    private $indexing;
    /**
     * @var bool
     */
    private $rootLevelDocument = false;

    /**
     * @param string $name
     * @param MappingInterface|null $mapping
     * @param IndexingInterface|null $indexing
     * @param bool $rootLevelDocument
     */
    public function __construct(
        string $name = null,
        MappingInterface $mapping = null,
        IndexingInterface $indexing = null,
        bool $rootLevelDocument = false
    ) {
        $this->name = $name;
        $this->mapping = $mapping ?? new Mapping();
        $this->indexing = $indexing ?? new Indexing();
        $this->rootLevelDocument = $rootLevelDocument;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): Descriptor
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getParentNames(): ?array
    {
        return $this->parentNames;
    }

    /**
     * @param string[] $parentNames
     * @return $this
     */
    public function setParentNames(array $parentNames): Descriptor
    {
        $this->parentNames = $parentNames;
        return $this;
    }

    /**
     * @return \AmaTeam\ElasticSearch\API\MappingInterface
     */
    public function getMapping(): MappingInterface
    {
        return $this->mapping;
    }

    /**
     * @param \AmaTeam\ElasticSearch\API\MappingInterface $mapping
     * @return $this
     */
    public function setMapping(MappingInterface $mapping): Descriptor
    {
        $this->mapping = $mapping;
        return $this;
    }

    /**
     * @return IndexingInterface
     */
    public function getIndexing(): IndexingInterface
    {
        return $this->indexing;
    }

    /**
     * @param IndexingInterface $indexing
     * @return $this
     */
    public function setIndexing(IndexingInterface $indexing): Descriptor
    {
        $this->indexing = $indexing;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRootLevelDocument(): bool
    {
        return $this->rootLevelDocument;
    }

    /**
     * @param bool $rootLevelDocument
     * @return $this
     */
    public function setRootLevelDocument(bool $rootLevelDocument): Descriptor
    {
        $this->rootLevelDocument = $rootLevelDocument;
        return $this;
    }
}
