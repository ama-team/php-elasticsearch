<?php

namespace AmaTeam\ElasticSearch\API\Entity\Descriptor;

use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;

interface RegistryInterface
{
    public function get(string $name): ?DescriptorInterface;
    public function has(string $name): bool;
    public function register(DescriptorInterface $descriptor): RegistryInterface;
}
