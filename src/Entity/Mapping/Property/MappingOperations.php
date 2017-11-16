<?php

namespace AmaTeam\ElasticSearch\Entity\Mapping\Property;

use AmaTeam\ElasticSearch\API\Entity\Mapping\Property\Mapping;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Property\MappingInterface;
use ReflectionProperty;

class MappingOperations
{
    public static function merge(MappingInterface ...$mappings): Mapping
    {
        $target = new Mapping();
        foreach ($mappings as $source) {
            $target
                ->setName($source->getName())
                ->setOriginalName($source->getOriginalName());
            $defaultView = ViewOperations::merge($target->getDefaultView(), $source->getDefaultView());
            $target->setDefaultView($defaultView);
            foreach ($source->getViews() as $name => $view) {
                $current = $target->getView($name);
                $pool = $current ? [$current, $view] : [$view];
                $target->setView($name, ViewOperations::merge(...$pool));
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
        return $mapping instanceof Mapping ? $mapping : static::from($mapping);
    }

    public static function fromReflection(ReflectionProperty $property)
    {
        return (new Mapping())
            ->setName($property->getName())
            ->setOriginalName($property->getName());
    }
}
