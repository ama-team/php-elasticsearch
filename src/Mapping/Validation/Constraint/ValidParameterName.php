<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ValidParameterName extends Constraint
{
    public $illegalValueMessage = 'Illegal value provided for ValidParameterName constraint';
    public $missingParameterMessage = 'Parameter `{{ name }}` doesn\'t exist';
    public $message = 'Parameter `{{ name }}` should be named as `{{ id }}`';

    public function validatedBy()
    {
        return ValidParameterNameValidator::class;
    }
}
