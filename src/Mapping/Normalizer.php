<?php

namespace AmaTeam\ElasticSearch\Mapping;

use AmaTeam\ElasticSearch\API\Mapping;
use AmaTeam\ElasticSearch\API\Mapping\Normalization\Context;
use AmaTeam\ElasticSearch\API\Mapping\Normalization\ContextInterface;
use AmaTeam\ElasticSearch\API\Mapping\NormalizerInterface;
use AmaTeam\ElasticSearch\API\MappingInterface;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\Registry;
use AmaTeam\ElasticSearch\Mapping\Type\RootType;

class Normalizer implements NormalizerInterface
{
    public function normalize(MappingInterface $mapping, ContextInterface $context = null): MappingInterface
    {
        $context = $context ?? new Context();
        $target = new Mapping();
        $type = $context->isRootMapping() ? RootType::ID : $mapping->getType();
        if ($type) {
            $target->setType($type);
        }
        $target->setParameters($this->normalizeParameters($mapping->getParameters(), $context));
        $target->setProperties($this->normalizeProperties($mapping->getProperties(), $context));
        return $target;
    }

    private function normalizeProperties(array $properties, ContextInterface $context): array
    {
        $result = [];
        $innerContext = Context::from($context)->setRootMapping(false);
        foreach ($properties as $name => $property) {
            $result[$name] = $this->normalize($property, $innerContext);
        }
        return $result;
    }

    private function normalizeParameters(array $parameters, ContextInterface $context): array
    {
        $result = [];
        $registry = Registry::getInstance();
        foreach ($parameters as $name => $value) {
            $parameter = $registry->find($name);
            if ($parameter) {
                if ($value !== null || $parameter->nullValueAllowed()) {
                    $result[$parameter->getId()] = $value;
                }
                continue;
            }
            if ($context->shouldPreserveUnknownParameters() || in_array($name, $context->getPreservedParameters())) {
                $result[$name] = $value;
            }
        }
        return $result;
    }
}
