<?php

namespace AmaTeam\ElasticSearch\API\Entity\Descriptor\Hierarchy;

use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;

interface BuilderInterface
{
    public function build(DescriptorInterface $descriptor): NodeInterface;
}
