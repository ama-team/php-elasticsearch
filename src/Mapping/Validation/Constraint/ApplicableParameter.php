<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ApplicableParameter extends Constraint
{
    public $type;
    public $message = 'Parameter {{ parameter }} is not applicable for type {{ type }}';
    public $illegalValueMessage = 'Illegal value of type {{ type }} provided for ApplicableParameter constraint';

    public function validatedBy()
    {
        return ApplicableParameterValidator::class;
    }
}
