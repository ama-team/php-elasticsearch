<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractParameter;
use Symfony\Component\Validator\Constraints\Type;

class PropertiesParameter extends AbstractParameter
{
    const ID = 'properties';
    const FRIENDLY_ID = self::ID;

    public function getId(): string
    {
        return self::ID;
    }

    public function getConstraints(): array
    {
        // TODO: add proper constraints
        return [new Type(['type' => 'array'])];
    }
}
