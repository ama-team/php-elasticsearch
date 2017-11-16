<?php

namespace AmaTeam\ElasticSearch\Entity\Descriptor\Hierarchy;

use AmaTeam\ElasticSearch\API\Entity\Descriptor\ManagerInterface;
use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;
use AmaTeam\ElasticSearch\API\Entity\Descriptor\Hierarchy\BuilderInterface;
use AmaTeam\ElasticSearch\API\Entity\Descriptor\Hierarchy\Node;
use AmaTeam\ElasticSearch\API\Entity\Descriptor\Hierarchy\NodeInterface;

class Builder implements BuilderInterface
{
    /**
     * @var ManagerInterface
     */
    private $manager;

    /**
     * @param ManagerInterface $manager
     */
    public function __construct(ManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function build(DescriptorInterface $descriptor): NodeInterface
    {
        $node = new Node($descriptor);
        $parents = [];
        if (empty($descriptor->getParentNames())) {
            return $node;
        }
        foreach ($descriptor->getParentNames() as $parentName) {
            $parents[] = $this->build($this->manager->get($parentName));
        }
        $node->setParents($parents);
        return $node;
    }
}
