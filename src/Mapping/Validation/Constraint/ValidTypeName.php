<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ValidTypeName extends Constraint
{
    public $nullValueMessage = 'Null provided instead of type name';
    public $illegalValueMessage = '{{ type }} is not a valid type for type name';
    public $missingMessage = 'Type `{{ name }}` doesn\'t exist';
    public $message = 'Type `{{ name }}` should be named as {{ id }}';

    /**
     * @inheritDoc
     */
    public function validatedBy()
    {
        return ValidTypeNameValidator::class;
    }
}
