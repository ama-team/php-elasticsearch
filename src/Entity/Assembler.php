<?php

namespace AmaTeam\ElasticSearch\Entity;

use AmaTeam\ElasticSearch\API\Entity;
use AmaTeam\ElasticSearch\API\Entity\AssemblerInterface;
use AmaTeam\ElasticSearch\API\Entity\Descriptor\Hierarchy\CompilerInterface;
use AmaTeam\ElasticSearch\API\Entity\Descriptor\Hierarchy\BuilderInterface;
use AmaTeam\ElasticSearch\API\Entity\Descriptor\ManagerInterface;
use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Conversion\DefaultContext;
use AmaTeam\ElasticSearch\API\Entity\Mapping\ConverterInterface;
use AmaTeam\ElasticSearch\API\EntityInterface;
use AmaTeam\ElasticSearch\Entity\Descriptor\Compiler;
use AmaTeam\ElasticSearch\Entity\Descriptor\Hierarchy\Builder;
use AmaTeam\ElasticSearch\Entity\Descriptor\Operations;
use AmaTeam\ElasticSearch\Entity\Mapping\Converter;

class Assembler implements AssemblerInterface
{
    /**
     * @var BuilderInterface
     */
    private $hierarchyBuilder;
    /**
     * @var CompilerInterface
     */
    private $compiler;
    /**
     * @var ConverterInterface
     */
    private $converter;

    /**
     * @param ManagerInterface $manager
     */
    public function __construct(ManagerInterface $manager)
    {
        $this->hierarchyBuilder = new Builder($manager);
        $this->compiler = new Compiler();
        $this->converter = new Converter($manager);
    }

    public function assemble(DescriptorInterface $descriptor): EntityInterface
    {
        $copy = $this->prepare($descriptor);
        $hierarchy = $this->hierarchyBuilder->build($copy);
        $compiled = $this->compiler->compile($hierarchy);
        $context = (new DefaultContext())->setRootLevelMapping(true);
        $mapping = $this->converter->convert($compiled->getMapping(), $context);
        return (new Entity($descriptor->getName()))
            ->setParentNames($compiled->getParentNames())
            ->setRootLevelDocument($compiled->isRootLevelDocument())
            ->setOriginalDescriptor(Operations::from($descriptor))
            ->setCompiledDescriptor($compiled)
            ->setHierarchy($hierarchy)
            ->setMapping($mapping)
            ->setIndexing($compiled->getIndexing());
    }

    private function prepare(DescriptorInterface $descriptor): DescriptorInterface
    {
        $copy = Operations::from($descriptor);
        if ($copy->getParentNames() === null) {
            $parent = get_parent_class($descriptor->getName());
            $copy->setParentNames($parent ? [$parent] : []);
        }
        return $copy;
    }
}
