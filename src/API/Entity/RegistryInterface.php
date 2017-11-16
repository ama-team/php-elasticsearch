<?php

namespace AmaTeam\ElasticSearch\API\Entity;

use AmaTeam\ElasticSearch\API\EntityInterface;

interface RegistryInterface
{
    public function get(string $name): EntityInterface;
    public function find(string $name): ?EntityInterface;
    public function exists(string $name): bool;
}
