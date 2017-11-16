<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Entity\Descriptor;

use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;

interface LoaderInterface
{
    public function exists(string $className): bool;
    public function load(string $className): ?DescriptorInterface;
}
