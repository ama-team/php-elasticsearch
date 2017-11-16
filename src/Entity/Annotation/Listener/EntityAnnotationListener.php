<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Entity\Annotation\Listener;

use AmaTeam\ElasticSearch\API\Annotation\Document as EntityAnnotation;
use AmaTeam\ElasticSearch\API\Entity\Descriptor;
use AmaTeam\ElasticSearch\Entity\Annotation\StructureAnnotationListenerInterface;
use AmaTeam\ElasticSearch\Indexing\Operations;
use ReflectionClass;

class EntityAnnotationListener implements StructureAnnotationListenerInterface
{
    public function accept(ReflectionClass $reflection, Descriptor $descriptor, $annotation): void
    {
        if (!($annotation instanceof EntityAnnotation)) {
            return;
        }
        $writeIndices = $annotation->writeIndices ?: [$reflection->getShortName()];
        $readIndices = $annotation->readIndices ?: [$reflection->getShortName()];
        $type = $annotation->type ?: 'doc';
        $indexing = Operations::toMutable($descriptor->getIndexing())
            ->setWriteIndices($writeIndices)
            ->setReadIndices($readIndices)
            ->setType($type);
        $descriptor
            ->setIndexing($indexing)
            ->setRootLevelDocument(true);
    }
}
