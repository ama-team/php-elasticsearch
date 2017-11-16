<?php

namespace AmaTeam\ElasticSearch\Entity\Annotation\Listener;

use AmaTeam\ElasticSearch\API\Annotation\Parents;
use AmaTeam\ElasticSearch\API\Entity\Descriptor;
use AmaTeam\ElasticSearch\Entity\Annotation\StructureAnnotationListenerInterface;
use phpDocumentor\Reflection\TypeResolver;
use phpDocumentor\Reflection\Types\ContextFactory;
use ReflectionClass;

class ParentsAnnotationListener implements StructureAnnotationListenerInterface
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

    public function accept(ReflectionClass $reflection, Descriptor $descriptor, $annotation): void
    {
        if (!($annotation instanceof Parents)) {
            return;
        }
        $parents = [];
        $context = $this->contextFactory->createFromReflector($reflection);
        foreach ($annotation->value as $type) {
            $parents[] = (string) $this->resolver->resolve($type, $context);
        }
        $descriptor->setParentNames($parents);
    }
}
