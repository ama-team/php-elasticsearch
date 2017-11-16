<?php

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractParameter;
use Symfony\Component\Validator\Constraints\Type;

class PointsOnlyParameter extends AbstractParameter
{
    const ID = 'points_only';
    const FRIENDLY_ID = 'pointsOnly';

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
        return [new Type('bool')];
    }
}
