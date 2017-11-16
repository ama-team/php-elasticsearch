<?php

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractParameter;
use Symfony\Component\Validator\Constraints\Choice;

class StrategyParameter extends AbstractParameter
{
    const ID = 'strategy';
    const FRIENDLY_ID = self::ID;

    const VALUE_TERM = 'term';
    const VALUE_RECURSIVE = 'recursive';

    public function getId(): string
    {
        return self::ID;
    }

    public function getConstraints(): array
    {
        $values = [self::VALUE_TERM, self::VALUE_RECURSIVE];
        return [new Choice(['strict' => true, 'choices' => $values])];
    }
}
