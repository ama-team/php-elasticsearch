<?php

namespace AmaTeam\ElasticSearch\Entity\Annotation\Listener;

use AmaTeam\ElasticSearch\API\Annotation\DisableInheritance;
use AmaTeam\ElasticSearch\API\Entity\Descriptor;
use AmaTeam\ElasticSearch\Entity\Annotation\StructureAnnotationListenerInterface;
use ReflectionClass;

class DisableInheritanceAnnotationListener implements StructureAnnotationListenerInterface
{
    public function accept(ReflectionClass $reflection, Descriptor $descriptor, $annotation): void
    {
        if (!($annotation instanceof DisableInheritance)) {
            return;
        }
        $descriptor->setParentNames([]);
    }
}
