<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Validation\Constraint;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\Registry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidTypeNameValidator extends ConstraintValidator
{
    /**
     * @inheritDoc
     * @param ValidTypeName $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $context = $this->context;
        if ($value === null) {
            $context
                ->buildViolation($constraint->nullValueMessage)
                ->addViolation();
        }
        if (!is_string($value)) {
            $context
                ->buildViolation($constraint->illegalValueMessage)
                ->setParameter('{{ type }}', gettype($value))
                ->addViolation();
            return;
        }
        $type = Registry::getInstance()->find($value);
        if (!$type) {
            $context
                ->buildViolation($constraint->missingMessage)
                ->setParameter('{{ name }}', $value)
                ->addViolation();
            return;
        }
        if ($type->getId() !== $value) {
            $context
                ->buildViolation($constraint->message)
                ->setParameter('{{ name }}', $value)
                ->setParameter('{{ id }}', $type->getId())
                ->addViolation();
        }
    }
}
