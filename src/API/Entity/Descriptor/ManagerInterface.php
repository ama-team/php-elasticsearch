<?php

namespace AmaTeam\ElasticSearch\API\Entity\Descriptor;

use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;

interface ManagerInterface
{
    public function get(string $name): DescriptorInterface;
    public function find(string $name): ?DescriptorInterface;
    public function exists(string $name): bool;
}
