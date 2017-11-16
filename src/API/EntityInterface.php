<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API;

use AmaTeam\ElasticSearch\API\Entity\Descriptor\Hierarchy\NodeInterface;
use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;

interface EntityInterface
{
    public function getName(): string;
    public function getParentNames(): array;
    public function isRootLevelDocument(): bool;

    public function getOriginalDescriptor(): DescriptorInterface;
    public function getCompiledDescriptor(): DescriptorInterface;

    /**
     * @return NodeInterface
     */
    public function getHierarchy(): NodeInterface;
    public function getMapping(): MappingInterface;
    public function getIndexing(): IndexingInterface;
}
