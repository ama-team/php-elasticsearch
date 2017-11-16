<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API;

use AmaTeam\ElasticSearch\API\Entity\Descriptor\Hierarchy\NodeInterface;
use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;

class Entity implements EntityInterface
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string[]
     */
    private $parentNames = [];
    /**
     * @var bool
     */
    private $rootLevelDocument = false;
    /**
     * @var DescriptorInterface
     */
    private $originalDescriptor;
    /**
     * @var DescriptorInterface
     */
    private $compiledDescriptor;
    /**
     * @var NodeInterface
     */
    private $hierarchy;
    /**
     * @var MappingInterface
     */
    private $mapping;
    /**
     * @var IndexingInterface
     */
    private $indexing;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
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
    public function setName(string $name): Entity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getParentNames(): array
    {
        return $this->parentNames;
    }

    /**
     * @param string[] $parentNames
     * @return $this
     */
    public function setParentNames(array $parentNames): Entity
    {
        $this->parentNames = $parentNames;
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
    public function setRootLevelDocument(bool $rootLevelDocument): Entity
    {
        $this->rootLevelDocument = $rootLevelDocument;
        return $this;
    }

    /**
     * @return DescriptorInterface
     */
    public function getOriginalDescriptor(): DescriptorInterface
    {
        return $this->originalDescriptor;
    }

    /**
     * @param DescriptorInterface $originalDescriptor
     * @return $this
     */
    public function setOriginalDescriptor(DescriptorInterface $originalDescriptor): Entity
    {
        $this->originalDescriptor = $originalDescriptor;
        return $this;
    }

    /**
     * @return DescriptorInterface
     */
    public function getCompiledDescriptor(): DescriptorInterface
    {
        return $this->compiledDescriptor;
    }

    /**
     * @param DescriptorInterface $compiledDescriptor
     * @return $this
     */
    public function setCompiledDescriptor(DescriptorInterface $compiledDescriptor): Entity
    {
        $this->compiledDescriptor = $compiledDescriptor;
        return $this;
    }

    /**
     * @return NodeInterface
     */
    public function getHierarchy(): NodeInterface
    {
        return $this->hierarchy;
    }

    /**
     * @param NodeInterface $hierarchy
     * @return $this
     */
    public function setHierarchy(NodeInterface $hierarchy): Entity
    {
        $this->hierarchy = $hierarchy;
        return $this;
    }

    /**
     * @return MappingInterface
     */
    public function getMapping(): MappingInterface
    {
        return $this->mapping;
    }

    /**
     * @param MappingInterface $mapping
     * @return $this
     */
    public function setMapping(MappingInterface $mapping): Entity
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
    public function setIndexing(IndexingInterface $indexing): Entity
    {
        $this->indexing = $indexing;
        return $this;
    }
}
