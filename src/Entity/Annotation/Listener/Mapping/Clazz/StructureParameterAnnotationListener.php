<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Entity\Annotation\Listener\Mapping\Clazz;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\ParameterAnnotationInterface;
use AmaTeam\ElasticSearch\API\Annotation\Mapping\Infrastructure\ViewAwareAnnotationInterface;
use AmaTeam\ElasticSearch\API\Entity\Descriptor;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Structure\View;
use AmaTeam\ElasticSearch\Entity\Annotation\StructureAnnotationListenerInterface;
use AmaTeam\ElasticSearch\Entity\Mapping\Structure\MappingOperations;
use AmaTeam\ElasticSearch\Entity\Mapping\Structure\ViewOperations;
use ReflectionClass;

class StructureParameterAnnotationListener implements StructureAnnotationListenerInterface
{
    public function accept(ReflectionClass $reflection, Descriptor $descriptor, $annotation): void
    {
        if (!($annotation instanceof ParameterAnnotationInterface)) {
            return;
        }
        $mapping = MappingOperations::toMutable($descriptor->getMapping());
        $descriptor->setMapping($mapping);
        $views = $annotation instanceof ViewAwareAnnotationInterface ? $annotation->getViews() : null;
        if (empty($views)) {
            $view = ViewOperations::toMutable($mapping->getDefaultView());
            $view->setParameter($annotation->getParameter(), $annotation->getValue());
            $mapping->setDefaultView($view);
            return;
        }
        foreach ($views as $name) {
            $view = ViewOperations::toMutable($mapping->getView($name) ?? new View());
            $view->setParameter($annotation->getParameter(), $annotation->getValue());
            $mapping->setView($name, $view);
        }
    }
}
