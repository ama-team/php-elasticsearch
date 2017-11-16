<?php

namespace AmaTeam\ElasticSearch\Mapping;

use AmaTeam\ElasticSearch\API\Mapping\Validation\Context;
use AmaTeam\ElasticSearch\API\Mapping\Validation\ContextInterface;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\Registry as Parameters;
use AmaTeam\ElasticSearch\Mapping\Validation\Constraint\ApplicableParameter;
use AmaTeam\ElasticSearch\Mapping\Validation\Constraint\ValidParameterName;
use AmaTeam\ElasticSearch\Mapping\Validation\Constraint\ValidTypeName;
use AmaTeam\ElasticSearch\API\Mapping\ValidatorInterface;
use AmaTeam\ElasticSearch\API\MappingInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ContextualValidatorInterface;

class Validator implements ValidatorInterface
{
    public function validate(
        MappingInterface $mapping,
        ContextInterface $context = null
    ): ConstraintViolationListInterface {
        $context = $context ? Context::from($context) : new Context();
        $validator = Validation::createValidator()->startContext();
        $this->validateInternal($mapping, $validator, $context);
        return $validator->getViolations();
    }

    private function validateInternal(
        MappingInterface $mapping,
        ContextualValidatorInterface $validator,
        Context $context
    ): void {
        $this->validateType($mapping, $validator, $context);
        $this->validateParameters($mapping, $validator, $context);
        $this->validateProperties($mapping, $validator, $context);
    }

    private function validateType(
        MappingInterface $mapping,
        ContextualValidatorInterface $validator,
        Context $context
    ): void {
        $segments = array_merge($context->getPath(), ['type']);
        $path = implode('.', $segments);
        $validator->atPath($path);
        $validator->validate($mapping->getType(), [new ValidTypeName()]);
    }

    private function validateParameters(
        MappingInterface $mapping,
        ContextualValidatorInterface $validator,
        Context $context
    ): void {
        foreach ($mapping->getParameters() as $name => $value) {
            $segments = array_merge($context->getPath(), [$name]);
            $validator->atPath(implode('.', $segments));
            $parameter = Parameters::getInstance()->find($name);
            if ($parameter || !$context->shouldPreserveUnknownParameters()) {
                $validator->validate($name, new ValidParameterName());
            }
            if (!$parameter) {
                continue;
            }
            if ($mapping->getType()) {
                $validator->validate($name, new ApplicableParameter(['type' => $mapping->getType()]));
            }
            $constraints = $parameter->getConstraints();
            if (!$parameter->nullValueAllowed()) {
                $constraints[] = new NotNull();
            }
            $validator->validate($value, $constraints);
        }
    }

    private function validateProperties(
        MappingInterface $mapping,
        ContextualValidatorInterface $validator,
        Context $context
    ): void {
        foreach ($mapping->getProperties() as $name => $property) {
            $innerContext = $context->withAppendedPath('properties', $name);
            $this->validateInternal($property, $validator, $innerContext);
        }
    }
}
