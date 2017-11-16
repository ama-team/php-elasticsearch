<?php

namespace AmaTeam\ElasticSearch\Indexing\Validation\Constraint;

use AmaTeam\ElasticSearch\Indexing\Option\Infrastructure\Registry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidOptionNameValidator extends ConstraintValidator
{
    /**
     * @inheritDoc
     * @param ValidOptionName $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $context = $this->context;
        if (!is_string($value)) {
            $context
                ->buildViolation($constraint->illegalValueMessage)
                ->setParameter('{{ type }}', gettype($value))
                ->addViolation();
            return;
        }
        $option = Registry::getInstance()->find($value);
        if (!$option) {
            $context
                ->buildViolation($constraint->missingOptionMessage)
                ->setParameter('{{ name }}', $value)
                ->addViolation();
            return;
        }
        if ($option->getId() !== $value) {
            $context
                ->buildViolation($constraint->message)
                ->setParameter('{{ name }}', $value)
                ->setParameter('{{ id }}', $option->getId())
                ->addViolation();
        }
    }
}
