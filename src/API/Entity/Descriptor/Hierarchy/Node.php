<?php

namespace AmaTeam\ElasticSearch\API\Entity\Descriptor\Hierarchy;

use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;

class Node implements NodeInterface
{
    /**
     * @var DescriptorInterface
     */
    private $value;
    /**
     * @var DescriptorInterface[]
     */
    private $parents = [];

    /**
     * @param DescriptorInterface $value
     */
    public function __construct(DescriptorInterface $value = null)
    {
        $this->value = $value;
    }

    /**
     * @return DescriptorInterface
     */
    public function getValue(): DescriptorInterface
    {
        return $this->value;
    }

    /**
     * @param DescriptorInterface $value
     * @return $this
     */
    public function setValue(DescriptorInterface $value): Node
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return DescriptorInterface[]
     */
    public function getParents(): array
    {
        return $this->parents;
    }

    /**
     * @param DescriptorInterface[] $parents
     * @return $this
     */
    public function setParents(array $parents): Node
    {
        $this->parents = $parents;
        return $this;
    }
}
