<?php

namespace AmaTeam\ElasticSearch\Entity;

use AmaTeam\ElasticSearch\API\Entity;
use AmaTeam\ElasticSearch\API\EntityInterface;

class Operations
{
    public static function from(EntityInterface $entity): Entity
    {
        return (new Entity($entity->getName()))
            ->setParentNames($entity->getParentNames())
            ->setOriginalDescriptor($entity->getOriginalDescriptor())
            ->setHierarchy($entity->getHierarchy())
            ->setCompiledDescriptor($entity->getCompiledDescriptor())
            ->setRootLevelDocument($entity->isRootLevelDocument())
            ->setIndexing($entity->getIndexing())
            ->setMapping($entity->getMapping());
    }
}
