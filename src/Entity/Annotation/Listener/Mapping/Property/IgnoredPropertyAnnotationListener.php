<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Entity\Annotation\Listener\Mapping\Property;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\IgnoredProperty;
use AmaTeam\ElasticSearch\API\Entity\Descriptor;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Structure\View;
use AmaTeam\ElasticSearch\Entity\Annotation\PropertyAnnotationListenerInterface;
use AmaTeam\ElasticSearch\Entity\Mapping\Structure\MappingOperations;
use AmaTeam\ElasticSearch\Entity\Mapping\Structure\ViewOperations;
use ReflectionProperty;

class IgnoredPropertyAnnotationListener implements PropertyAnnotationListenerInterface
{
    public function accept(ReflectionProperty $property, Descriptor $descriptor, $annotation): void
    {
        if (!($annotation instanceof IgnoredProperty)) {
            return;
        }
        $mapping = MappingOperations::toMutable($descriptor->getMapping());
        $descriptor->setMapping($mapping);
        if (empty($annotation->views)) {
            $view = ViewOperations::toMutable($mapping->getDefaultView());
            $view->addIgnoredProperty($property->getName());
            $mapping->setDefaultView($view);
            return;
        }
        foreach ($annotation->views as $name) {
            $view = ViewOperations::toMutable($mapping->getView($name) ?? new View());
            $view->addIgnoredProperty($property->getName());
            $mapping->setView($name, $view);
        }
    }
}
