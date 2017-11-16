<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Entity\Annotation\Listener\Mapping\Property;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\TargetEntity;
use AmaTeam\ElasticSearch\API\Entity\Descriptor;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Property\View;
use AmaTeam\ElasticSearch\Entity\Annotation\PropertyAnnotationListenerInterface;
use AmaTeam\ElasticSearch\Entity\Mapping\Property\MappingOperations;
use AmaTeam\ElasticSearch\Entity\Mapping\Property\ViewOperations;
use AmaTeam\ElasticSearch\Entity\Mapping\Structure\MappingOperations as StructureOperations;
use phpDocumentor\Reflection\TypeResolver;
use phpDocumentor\Reflection\Types\ContextFactory;
use ReflectionProperty;

class TargetEntityAnnotationListener implements PropertyAnnotationListenerInterface
{
    /**
     * @var TypeResolver
     */
    private $resolver;
    /**
     * @var ContextFactory
     */
    private $contextFactory;

    public function __construct()
    {
        $this->resolver = new TypeResolver();
        $this->contextFactory = new ContextFactory();
    }

    public function accept(ReflectionProperty $property, Descriptor $descriptor, $annotation): void
    {
        if (!($annotation instanceof TargetEntity)) {
            return;
        }
        $context = $this->contextFactory->createFromReflector($property);
        $type = $this->resolver->resolve($annotation->value, $context);
        $className = (string) $type;
        $structure = StructureOperations::toMutable($descriptor->getMapping());
        $descriptor->setMapping($structure);
        $mapping = $structure->getProperty($property->getName()) ?? MappingOperations::fromReflection($property);
        $mapping = MappingOperations::toMutable($mapping);
        $structure->setProperty($property->getName(), $mapping);
        if (empty($annotation->views)) {
            $view = ViewOperations::toMutable($mapping->getDefaultView());
            $view->setTargetEntity($className);
            $mapping->setDefaultView($view);
            return;
        }
        foreach ($annotation->views as $name) {
            $view = ViewOperations::toMutable($mapping->getView($name) ?? new View());
            $view->setTargetEntity($className);
            $mapping->setView($name, $view);
        }
    }
}
