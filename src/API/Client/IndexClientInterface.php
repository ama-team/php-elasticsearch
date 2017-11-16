<?php

namespace AmaTeam\ElasticSearch\API\Client;

use AmaTeam\ElasticSearch\API\IndexingInterface;
use AmaTeam\ElasticSearch\API\MappingInterface;

interface IndexClientInterface
{
    /**
     * @param string $index
     * @param IndexingInterface|null $indexing
     * @param MappingInterface[] $mappings
     */
    public function create(string $index, IndexingInterface $indexing = null, array $mappings = []): void;
    public function exists(string $index): bool;
    public function delete(string $index): void;
    public function setMapping(string $index, string $type, MappingInterface $mapping): void;
    public function getMapping(string $index, string $type): ?MappingInterface;
    public function setIndexing(string $index, IndexingInterface $indexing): void;
    // get indexing operation is not implemented because of design
    // flaw - Indexing doesn't map to index settings one-to-one
}
