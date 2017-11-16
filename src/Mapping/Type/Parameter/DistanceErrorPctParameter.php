<?php

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractParameter;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\Type;

class DistanceErrorPctParameter extends AbstractParameter
{
    const ID = 'distance_error_pct';
    const FRIENDLY_ID = 'distanceErrorPct';

    public function getId(): string
    {
        return self::ID;
    }

    public function getConstraints(): array
    {
        return [new Type('float'), new GreaterThanOrEqual(0), new LessThanOrEqual(0.5)];
    }
}
