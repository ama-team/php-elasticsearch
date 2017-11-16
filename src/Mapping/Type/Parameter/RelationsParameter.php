<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractParameter;
use PHPUnit\Framework\Constraint\Count;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Type;

class RelationsParameter extends AbstractParameter
{
    const ID = 'relations';
    const FRIENDLY_ID = self::ID;

    public function getId(): string
    {
        return self::ID;
    }

    public function getConstraints(): array
    {
        return [
            new Type(['type' => 'array']),
            new Count(1),
            new All(['type' => new Type('string')])
        ];
    }
}
