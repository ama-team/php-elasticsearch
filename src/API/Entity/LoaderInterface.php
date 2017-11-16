<?php

namespace AmaTeam\ElasticSearch\API\Entity;

use AmaTeam\ElasticSearch\API\Entity\Loader\ContextInterface;
use AmaTeam\ElasticSearch\API\EntityInterface;

interface LoaderInterface
{
    public function load(string $name, ContextInterface $context = null): ?EntityInterface;
    public function exists(string $name): bool;
}
