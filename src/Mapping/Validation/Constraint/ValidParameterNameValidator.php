<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Validation\Constraint;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\Registry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidParameterNameValidator extends ConstraintValidator
{
    /**
     * @inheritDoc
     * @param ValidParameterName $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $context = $this->context;
        if (!is_string($value)) {
            $context
                ->buildViolation($constraint->illegalValueMessage)
                ->addViolation();
            return;
        }
        $parameter = Registry::getInstance()->find($value);
        if (!$parameter) {
            $context
                ->buildViolation($constraint->missingParameterMessage)
                ->setParameter('{{ name }}', $value)
                ->addViolation();
            return;
        }
        if ($value !== $parameter->getId()) {
            $this
                ->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ id }}', $parameter->getId())
                ->setParameter('{{ name }}', $value)
                ->addViolation();
        }
    }
}
