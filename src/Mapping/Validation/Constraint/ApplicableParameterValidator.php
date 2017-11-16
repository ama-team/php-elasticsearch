<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Validation\Constraint;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\Registry as TypeRegistry;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\Registry as ParameterRegistry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ApplicableParameterValidator extends ConstraintValidator
{
    /**
     * @inheritDoc
     * @param ApplicableParameter $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (!is_string($value)) {
            $this
                ->context
                ->buildViolation($constraint->illegalValueMessage)
                ->setParameter('{{ type }}', gettype($value))
                ->addViolation();
            return;
        }
        $type = TypeRegistry::getInstance()->find($constraint->type);
        $parameter = ParameterRegistry::getInstance()->find($value);
        if (!$type || !$parameter || !in_array($parameter, $type->getParameters())) {
            $this
                ->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ type }}', $constraint->type)
                ->setParameter('{{ parameter }}', $value)
                ->addViolation();
        }
    }
}
