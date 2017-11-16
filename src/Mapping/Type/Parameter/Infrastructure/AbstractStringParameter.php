<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure;

use Symfony\Component\Validator\Constraints\Type;

abstract class AbstractStringParameter extends AbstractParameter
{
    public function getConstraints(): array
    {
        return [new Type(['type' => 'string'])];
    }
}
