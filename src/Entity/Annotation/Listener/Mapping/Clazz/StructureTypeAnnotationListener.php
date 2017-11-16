<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Entity\Annotation\Listener\Mapping\Clazz;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Type;
use AmaTeam\ElasticSearch\API\Entity\Descriptor;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Structure\View;
use AmaTeam\ElasticSearch\Entity\Annotation\StructureAnnotationListenerInterface;
use AmaTeam\ElasticSearch\Entity\Mapping\Structure\MappingOperations;
use AmaTeam\ElasticSearch\Entity\Mapping\Structure\ViewOperations;
use ReflectionClass;

class StructureTypeAnnotationListener implements StructureAnnotationListenerInterface
{
    public function accept(ReflectionClass $reflection, Descriptor $descriptor, $annotation): void
    {
        if (!($annotation instanceof Type)) {
            return;
        }
        $mapping = MappingOperations::toMutable($descriptor->getMapping());
        $descriptor->setMapping($mapping);
        if (empty($annotation->views)) {
            $view = ViewOperations::toMutable($mapping->getDefaultView());
            $view->setType($annotation->value);
            $mapping->setDefaultView($view);
            return;
        }
        foreach ($annotation->views as $name) {
            $view = ViewOperations::toMutable($mapping->getView($name) ?? new View());
            $view->setType($annotation->value);
            $mapping->setView($name, $view);
        }
    }
}
