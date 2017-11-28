<?php

namespace AmaTeam\ElasticSearch\Mapping;

use AmaTeam\ElasticSearch\API\Mapping;
use AmaTeam\ElasticSearch\API\MappingInterface;
use stdClass;

class Operations
{
    const KEY_PROPERTIES = 'properties';
    const KEY_TYPE = 'type';

    public static function merge(MappingInterface ...$mappings): Mapping
    {
        $target = new Mapping();
        foreach ($mappings as $source) {
            if ($source->getType()) {
                $target->setType($source->getType());
            }
            foreach ($source->getParameters() as $parameter => $value) {
                $target->setParameter($parameter, $value);
            }
            foreach ($source->getProperties() as $property => $mapping) {
                $candidate = $target->getProperty($property);
                $target->setProperty($property, $candidate ? static::merge($candidate, $mapping) : $mapping);
            }
        }
        return $target;
    }

    public static function from(MappingInterface $mapping): Mapping
    {
        return static::merge($mapping);
    }
    public static function conflict(MappingInterface ...$mappings): bool
    {
        $mappings = array_values($mappings);
        for ($i = 0; $i < sizeof($mappings) - 1; $i++) {
            $subject = $mappings[$i];
            for ($j = $i + 1; $j < sizeof($mappings); $j++) {
                if (static::haveConflicts($subject, $mappings[$j])) {
                    return true;
                }
            }
        }
        return false;
    }

    private static function haveConflicts(MappingInterface $subject, MappingInterface $opponent): bool
    {
        if (static::haveTypeConflict($subject, $opponent)) {
            return true;
        }
        if (static::haveParameterConflicts($subject, $opponent)) {
            return true;
        }
        return static::havePropertyConflicts($subject, $opponent);
    }

    private static function haveTypeConflict(MappingInterface $subject, MappingInterface $opponent): bool
    {
        return $subject->getType() && $opponent->getType() && $subject->getType() !== $opponent->getType();
    }

    private static function haveParameterConflicts(MappingInterface $subject, MappingInterface $opponent): bool
    {
        foreach ($subject->getParameters() as $parameter => $value) {
            if ($opponent->hasParameter($parameter) && $opponent->getParameter($parameter) != $value) {
                return true;
            }
        }
        return false;
    }

    private static function havePropertyConflicts(MappingInterface $subject, MappingInterface $opponent): bool
    {
        foreach ($subject->getProperties() as $name => $property) {
            if ($opponent->hasProperty($name) && static::haveConflicts($property, $opponent->getProperty($name))) {
                return true;
            }
        }
        return false;
    }

    public static function toArray(MappingInterface $mapping): array
    {
        $target = [];
        foreach ($mapping->getParameters() as $parameter => $value) {
            $target[$parameter] = $value;
        }
        if (!empty($mapping->getProperties())) {
            $properties = [];
            foreach ($mapping->getProperties() as $name => $property) {
                $properties[$name] = static::toArray($property);
            }
            $target[self::KEY_PROPERTIES] = $properties;
        }
        if ($mapping->getType()) {
            $target[self::KEY_TYPE] = $mapping->getType();
        }
        return $target;
    }

    public static function toStdObject(MappingInterface $mapping)
    {
        $target = new stdClass();
        foreach ($mapping->getParameters() as $parameter => $value) {
            $target->$parameter = $value;
        }
        if (!empty($mapping->getProperties())) {
            $properties = [];
            foreach ($mapping->getProperties() as $name => $property) {
                $properties[$name] = static::toStdObject($property);
            }
            $target->properties = $properties;
        }
        if ($mapping->getType()) {
            $target->type = $mapping->getType();
        }
        return $target;
    }

    public static function fromArray(array $source): Mapping
    {
        $target = new Mapping();
        if (isset($source[self::KEY_TYPE])) {
            $target->setType($source[self::KEY_TYPE]);
        }
        if (isset($source[self::KEY_PROPERTIES]) && is_array($source[self::KEY_PROPERTIES])) {
            $properties = [];
            foreach ($source[self::KEY_PROPERTIES] as $property => $mapping) {
                $properties[$property] = static::fromArray($mapping);
            }
            $target->setProperties($properties);
        }
        $parameters = [];
        foreach ($source as $parameter => $value) {
            if (in_array($parameter, [self::KEY_PROPERTIES, self::KEY_TYPE])) {
                continue;
            }
            $parameters[$parameter] = $value;
        }
        $target->setParameters($parameters);
        return $target;
    }
}
