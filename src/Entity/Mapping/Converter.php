<?php

namespace AmaTeam\ElasticSearch\Entity\Mapping;

use AmaTeam\ElasticSearch\API\Entity\Descriptor\ManagerInterface;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Conversion\ContextInterface;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Conversion\DefaultContext;
use AmaTeam\ElasticSearch\API\Entity\Mapping\ConverterInterface;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Property\MappingInterface as PropertyMappingInterface;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Property\ViewInterface as PropertyViewInterface;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Structure\MappingInterface as StructureMappingInterface;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Structure\ViewInterface as StructureViewInterface;
use AmaTeam\ElasticSearch\API\MappingInterface;
use AmaTeam\ElasticSearch\API\Mapping;
use AmaTeam\ElasticSearch\Entity\Mapping\Structure\ViewOperations as StructureViews;
use AmaTeam\ElasticSearch\Entity\Mapping\Property\ViewOperations as PropertyViews;
use AmaTeam\ElasticSearch\Mapping\Type\RootType;

class Converter implements ConverterInterface
{
    /**
     * @var ManagerInterface
     */
    private $manager;

    /**
     * @param ManagerInterface $manager
     */
    public function __construct(ManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function convert(StructureMappingInterface $mapping, ContextInterface $context = null): MappingInterface
    {
        return $this->convertStructureMapping($mapping, $context ?? new DefaultContext());
    }
    
    private function convertStructureMapping(StructureMappingInterface $mapping, ContextInterface $context): Mapping
    {
        $target = new Mapping();
        $views = static::computeStructureViews($mapping, $context);
        $view = StructureViews::merge(...$views);
        $type = $context->isRootLevelMapping() ? RootType::ID : $view->getType();
        if ($type) {
            $target->setType($type);
        }
        foreach ($view->getParameters() as $parameter => $value) {
            $target->setParameter($parameter, $value);
        }
        foreach ($mapping->getProperties() as $name => $property) {
            if (in_array($name, $view->getIgnoredProperties(), true)) {
                continue;
            }
            $innerContext = DefaultContext::from($context)->setRootLevelMapping(false);
            $target->setProperty($name, $this->convertPropertyMapping($property, $innerContext));
        }
        return $target;
    }
    
    private function convertPropertyMapping(PropertyMappingInterface $mapping, ContextInterface $context): Mapping
    {
        $views = static::computePropertyViews($mapping, $context);
        $view = PropertyViews::merge(...$views);
        $target = new Mapping();
        if ($view->getTargetEntity()) {
            $descriptor = $this->manager->get($view->getTargetEntity());
            $viewNames = static::computeChildViews($view, $context);
            $innerContext = DefaultContext::from($context)
                ->setViews($viewNames)
                ->setRootLevelMapping(false);
            $target = $this->convertStructureMapping($descriptor->getMapping(), $innerContext);
        }
        if ($view->getType()) {
            $target->setType($view->getType());
        }
        foreach ($view->getParameters() as $parameter => $value) {
            $target->setParameter($parameter, $value);
        }
        return $target;
    }

    /**
     * @param StructureMappingInterface $mapping
     * @param ContextInterface $context
     * @return StructureViewInterface[]
     */
    private static function computeStructureViews(StructureMappingInterface $mapping, ContextInterface $context): array
    {
        $result = [$mapping->getDefaultView()];
        $sources = $mapping->getViews();
        foreach ($context->getViews() as $name) {
            if (isset($sources[$name])) {
                $result[] = $sources[$name];
            }
        }
        return $result;
    }

    /**
     * @param PropertyMappingInterface $mapping
     * @param ContextInterface $context
     * @return PropertyViewInterface[]
     */
    private static function computePropertyViews(PropertyMappingInterface $mapping, ContextInterface $context): array
    {
        $result = [$mapping->getDefaultView()];
        $sources = $mapping->getViews();
        foreach ($context->getViews() as $name) {
            if (isset($sources[$name])) {
                $result[] = $sources[$name];
            }
        }
        return $result;
    }

    private static function computeChildViews(PropertyViewInterface $view, ContextInterface $context): array
    {
        if (!$view->shouldAppendChildViews()) {
            return $view->getChildViews() ?? [];
        }
        return array_unique(array_merge($context->getViews(), $view->getChildViews()));
    }
}
