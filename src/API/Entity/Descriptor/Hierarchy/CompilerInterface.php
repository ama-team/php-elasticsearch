<?php

namespace AmaTeam\ElasticSearch\API\Entity\Descriptor\Hierarchy;

use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;

interface CompilerInterface
{
    public function compile(NodeInterface $hierarchy): DescriptorInterface;
}
