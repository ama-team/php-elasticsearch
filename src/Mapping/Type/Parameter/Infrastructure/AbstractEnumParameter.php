<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure;

use Symfony\Component\Validator\Constraints\Choice;

abstract class AbstractEnumParameter extends AbstractParameter
{
    abstract public function getAllowedValues();

    public function getConstraints(): array
    {
        return [new Choice(['choices' => $this->getAllowedValues(), 'strict' => true])];
    }
}
