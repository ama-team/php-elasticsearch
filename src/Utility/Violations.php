<?php

namespace AmaTeam\ElasticSearch\Utility;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationInterface;

class Violations
{
    public static function remap(ConstraintViolationInterface $violation, $root, string $path): ConstraintViolation
    {
        $propertyPath = $path . '.' . $violation->getPropertyPath();
        $cause = null;
        $constraint = null;
        if ($violation instanceof ConstraintViolation) {
            $cause = $violation->getCause();
            $constraint = $violation->getConstraint();
        }
        return new ConstraintViolation(
            $violation->getMessage(),
            $violation->getMessageTemplate(),
            $violation->getParameters(),
            $root,
            $propertyPath,
            $violation->getInvalidValue(),
            $violation->getPlural(),
            $violation->getCode(),
            $constraint,
            $cause
        );
    }
}
