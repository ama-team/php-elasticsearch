<?php

namespace AmaTeam\ElasticSearch\Entity\Descriptor;

use AmaTeam\ElasticSearch\API\Entity\Descriptor;
use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;
use AmaTeam\ElasticSearch\Indexing\Operations as IndexingOperations;
use AmaTeam\ElasticSearch\Entity\Mapping\Structure\MappingOperations;

class Operations
{
    public static function from(DescriptorInterface $source): Descriptor
    {
        $target = new Descriptor(
            $source->getName(),
            $source->getMapping(),
            $source->getIndexing()
        );
        if ($source->getParentNames() !== null) {
            $target->setParentNames($source->getParentNames());
        }
        $target->setRootLevelDocument($source->isRootLevelDocument());
        return $target;
    }

    public static function extend(DescriptorInterface $parent, DescriptorInterface $child): Descriptor
    {
        $target = static::from($child);
        $mapping = MappingOperations::extend($parent->getMapping(), $child->getMapping());
        $indexing = IndexingOperations::merge($parent->getIndexing(), $child->getIndexing());
        return $target
            ->setMapping($mapping)
            ->setIndexing($indexing);
    }
}
