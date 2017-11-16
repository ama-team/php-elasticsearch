<?php

namespace AmaTeam\ElasticSearch\Entity\Descriptor;

use AmaTeam\ElasticSearch\API\Entity\Descriptor\Hierarchy\CompilerInterface;
use AmaTeam\ElasticSearch\API\Entity\Descriptor\Hierarchy\NodeInterface;
use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;

class Compiler implements CompilerInterface
{
    public function compile(NodeInterface $hierarchy): DescriptorInterface
    {
        $target = Operations::from($hierarchy->getValue());
        foreach ($hierarchy->getParents() as $parent) {
            $parent = $this->compile($parent);
            $target = Operations::extend($parent, $target);
        }
        return $target;
    }
}
