<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure;

use Symfony\Component\Validator\Constraints\Type;

abstract class AbstractBooleanParameter extends AbstractParameter
{
    public function getConstraints(): array
    {
        return [new Type(['type' => 'bool'])];
    }
}
