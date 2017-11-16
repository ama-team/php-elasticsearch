<?php

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractParameter;
use Symfony\Component\Validator\Constraints\Type;

class TreeLevelsParameter extends AbstractParameter
{
    const ID = 'tree_levels';
    const FRIENDLY_ID = 'treeLevels';

    public function getId(): string
    {
        return self::ID;
    }

    public function getFriendlyId(): string
    {
        return self::FRIENDLY_ID;
    }

    public function getConstraints(): array
    {
        return [new Type('string')];
    }
}
