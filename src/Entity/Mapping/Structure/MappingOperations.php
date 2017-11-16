<?php

namespace AmaTeam\ElasticSearch\Entity\Mapping\Structure;

use AmaTeam\ElasticSearch\API\Entity\Mapping\Structure\Mapping;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Structure\MappingInterface;
use AmaTeam\ElasticSearch\Entity\Mapping\Property\MappingOperations as PropertyMappingOperations;

class MappingOperations
{
    public static function merge(MappingInterface... $mappings): Mapping
    {
        $target = new Mapping();
        foreach ($mappings as $source) {
            if ($source->getIgnoredParentProperties() !== null) {
                $target->setIgnoredParentProperties($source->getIgnoredParentProperties());
            }
            $defaultView = ViewOperations::merge($target->getDefaultView(), $source->getDefaultView());
            $target->setDefaultView($defaultView);
            foreach ($source->getViews() as $name => $view) {
                $current = $target->getView($name);
                $pool = $current ? [$current, $view] : [$view];
                $target->setView($name, ViewOperations::merge(...$pool));
            }
            foreach ($source->getProperties() as $name => $property) {
                $current = $target->getProperty($name);
                $pool = $current ? [$current, $property] : [$property];
                $target->setProperty($name, PropertyMappingOperations::merge(...$pool));
            }
        }
        return $target;
    }

    public static function from(MappingInterface $mapping): Mapping
    {
        return static::merge($mapping);
    }

    public static function toMutable(MappingInterface $mapping): Mapping
    {
        if ($mapping instanceof Mapping) {
            return $mapping;
        }
        return static::from($mapping);
    }

    public static function extend(MappingInterface $parent, MappingInterface $child): Mapping
    {
        $target = static::from($parent);
        $ignoredProperties = $child->getIgnoredParentProperties() ?? [];
        foreach ($ignoredProperties as $property) {
            $target->removeProperty($property);
        }
        return static::merge($target, $child);
    }
}
