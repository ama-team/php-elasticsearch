<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Entity\Annotation\Listener\Mapping\Clazz;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\IgnoredParentProperties;
use AmaTeam\ElasticSearch\API\Entity\Descriptor;
use AmaTeam\ElasticSearch\Entity\Annotation\StructureAnnotationListenerInterface;
use AmaTeam\ElasticSearch\Entity\Mapping\Structure\MappingOperations;
use ReflectionClass;

class IgnoredParentPropertiesAnnotationListener implements StructureAnnotationListenerInterface
{
    public function accept(ReflectionClass $reflection, Descriptor $descriptor, $annotation): void
    {
        if (!($annotation instanceof IgnoredParentProperties)) {
            return;
        }
        $mapping = MappingOperations::toMutable($descriptor->getMapping());
        $mapping->setIgnoredParentProperties($annotation->value);
        $descriptor->setMapping($mapping);
    }
}
