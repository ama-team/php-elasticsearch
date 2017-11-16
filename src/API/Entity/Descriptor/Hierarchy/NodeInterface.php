<?php

namespace AmaTeam\ElasticSearch\API\Entity\Descriptor\Hierarchy;

use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;

interface NodeInterface
{
    public function getValue(): DescriptorInterface;

    /**
     * @return NodeInterface[]
     */
    public function getParents(): array;
}
