<?php

namespace AmaTeam\ElasticSearch\API\Framework;

interface OperationsManagerInterface
{
    /**
     * Ensures index with proper mapping exists for specified entity.
     *
     * In case index exists and has unexpected indexing / mapping,
     * fails with exception.
     *
     * @param string $entity
     */
    public function setUp(string $entity): void;
}
