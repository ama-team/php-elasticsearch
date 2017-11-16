<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Entity\Annotation\Listener\Mapping\Property;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Infrastructure\TypeAnnotationInterface;
use AmaTeam\ElasticSearch\API\Entity\Descriptor;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Property\View;
use AmaTeam\ElasticSearch\Entity\Annotation\PropertyAnnotationListenerInterface;
use AmaTeam\ElasticSearch\Entity\Mapping\Property\MappingOperations;
use AmaTeam\ElasticSearch\Entity\Mapping\Property\ViewOperations;
use AmaTeam\ElasticSearch\Entity\Mapping\Structure\MappingOperations as StructureOperations;
use ReflectionProperty;

class TypePropertyAnnotationListener implements PropertyAnnotationListenerInterface
{
    public function accept(ReflectionProperty $property, Descriptor $descriptor, $annotation): void
    {
        if (!($annotation instanceof TypeAnnotationInterface)) {
            return;
        }
        $structure = StructureOperations::toMutable($descriptor->getMapping());
        $descriptor->setMapping($structure);
        $mapping = $structure->getProperty($property->getName()) ?? MappingOperations::fromReflection($property);
        $mapping = MappingOperations::toMutable($mapping);
        $structure->setProperty($property->getName(), $mapping);
        if (empty($annotation->views)) {
            $view = ViewOperations::toMutable($mapping->getDefaultView());
            $view->setType($annotation->getValue());
            $mapping->setDefaultView($view);
            return;
        }
        foreach ($annotation->views as $name) {
            $view = ViewOperations::toMutable($mapping->getView($name) ?? new View());
            $view->setType($annotation->getValue());
            $mapping->setView($name, $view);
        }
    }
}
