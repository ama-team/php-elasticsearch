<?php

namespace AmaTeam\ElasticSearch\API\Entity;

use AmaTeam\ElasticSearch\API\Entity\Mapping\Structure\MappingInterface;
use AmaTeam\ElasticSearch\API\IndexingInterface;

/**
 * Container for single metadata information.
 *
 * Please note that provided mapping is actually a structure mapping.
 */
interface DescriptorInterface
{
    public function getName(): string;

    /**
     * Returns list of parents. Null is a special value that tells
     * processor to use real class parent
     *
     * @return string[]|null
     */
    public function getParentNames(): ?array;
    public function getMapping(): MappingInterface;
    public function getIndexing(): IndexingInterface;
    public function isRootLevelDocument(): bool;
}
