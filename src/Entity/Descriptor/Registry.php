<?php

namespace AmaTeam\ElasticSearch\Entity\Descriptor;

use AmaTeam\ElasticSearch\API\Entity\Descriptor\RegistryInterface;
use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;

class Registry implements RegistryInterface
{
    /**
     * @var DescriptorInterface[]
     */
    private $descriptors = [];

    public function get(string $name): ?DescriptorInterface
    {
        return $this->descriptors[$name] ?? null;
    }

    public function has(string $name): bool
    {
        return isset($this->descriptors[$name]);
    }

    public function register(DescriptorInterface $descriptor): RegistryInterface
    {
        $this->descriptors[$descriptor->getName()] = $descriptor;
        return $this;
    }
}
