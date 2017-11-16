<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Entity\Annotation;

use AmaTeam\ElasticSearch\API\Annotation\Embeddable;
use AmaTeam\ElasticSearch\API\Entity\Descriptor;
use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;
use AmaTeam\ElasticSearch\API\Indexing;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Structure\Mapping;
use AmaTeam\ElasticSearch\API\Entity\Descriptor\LoaderInterface;
use AmaTeam\ElasticSearch\Utility\Classes;
use Doctrine\Common\Annotations\AnnotationReader;
use ReflectionClass;
use ReflectionProperty;

class Loader implements LoaderInterface
{
    /**
     * @var AnnotationReader
     */
    private $annotationReader;
    /**
     * @var StructureAnnotationListenerInterface[]
     */
    private $classListeners = [];
    /**
     * @var PropertyAnnotationListenerInterface[]
     */
    private $propertyListeners = [];

    /**
     * @param AnnotationReader $annotationReader
     */
    public function __construct(AnnotationReader $annotationReader = null)
    {
        $this->annotationReader = $annotationReader ?: new AnnotationReader();
        $this->registerLoaders();
    }

    /**
     * @param string $className
     * @return bool
     */
    public function exists(string $className): bool
    {
        if (!class_exists($className)) {
            return false;
        }
        $reflection = new ReflectionClass($className);
        return (bool) $this->annotationReader->getClassAnnotation($reflection, Embeddable::class);
    }

    public function load(string $className): ?DescriptorInterface
    {
        $className = Classes::normalizeAbsoluteName($className);
        if (!$this->exists($className)) {
            return null;
        }
        $descriptor = new Descriptor($className, new Mapping(), new Indexing());
        $reflection = new ReflectionClass($className);
        foreach ($this->annotationReader->getClassAnnotations($reflection) as $annotation) {
            foreach ($this->classListeners as $listener) {
                $listener->accept($reflection, $descriptor, $annotation);
            }
        }
        foreach ($reflection->getProperties(~ReflectionProperty::IS_STATIC) as $property) {
            if ($property->getDeclaringClass()->getName() !== $reflection->getName()) {
                continue;
            }
            foreach ($this->annotationReader->getPropertyAnnotations($property) as $annotation) {
                foreach ($this->propertyListeners as $listener) {
                    $listener->accept($property, $descriptor, $annotation);
                }
            }
        }
        return $descriptor;
    }

    private function registerLoaders()
    {
        $this->classListeners = ListenerProvider::getClassListeners();
        $this->propertyListeners = ListenerProvider::getPropertyListeners();
    }
}
