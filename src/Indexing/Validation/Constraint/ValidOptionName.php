<?php

namespace AmaTeam\ElasticSearch\Indexing\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

class ValidOptionName extends Constraint
{
    public $illegalValueMessage = 'Option can\'t be specified using {{ type }}';
    public $missingOptionMessage = 'Option {{ name }} doesn\'t exist';
    public $message = 'Option {{ name }} should be specified as {{ id }}';

    public function validatedBy()
    {
        return ValidOptionNameValidator::class;
    }
}
