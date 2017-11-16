<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Entity\Annotation\Listener\Indexing;

use AmaTeam\ElasticSearch\API\Annotation\Indexing\Infrastructure\OptionAnnotationInterface;
use AmaTeam\ElasticSearch\API\Entity\Descriptor;
use AmaTeam\ElasticSearch\Entity\Annotation\StructureAnnotationListenerInterface;
use AmaTeam\ElasticSearch\Indexing\Operations;
use ReflectionClass;

class ParameterAnnotationListener implements StructureAnnotationListenerInterface
{
    public function accept(ReflectionClass $reflection, Descriptor $descriptor, $annotation): void
    {
        if (!($annotation instanceof OptionAnnotationInterface)) {
            return;
        }
        $id = $annotation->getOption()->getId();
        $indexing = Operations::toMutable($descriptor->getIndexing())->setOption($id, $annotation->getValue());
        $descriptor->setIndexing($indexing);
    }
}
