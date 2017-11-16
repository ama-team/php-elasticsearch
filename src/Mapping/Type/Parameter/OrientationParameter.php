<?php

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractParameter;
use Symfony\Component\Validator\Constraints\Choice;

class OrientationParameter extends AbstractParameter
{
    const ID = 'orientation';
    const FRIENDLY_ID = self::ID;

    const VALUE_LEFT = 'left';
    const VALUE_CCW = 'ccw';
    const VALUE_COUNTERCLOCKWISE = 'counterclockwise';
    const VALUE_RIGHT = 'right';
    const VALUE_CW = 'cw';
    const VALUE_CLOCKWISE = 'clockwise';

    public function getId(): string
    {
        return self::ID;
    }

    public function getConstraints(): array
    {
        $values = [
            self::VALUE_LEFT,
            self::VALUE_CCW,
            self::VALUE_COUNTERCLOCKWISE,
            self::VALUE_RIGHT,
            self::VALUE_CW,
            self::VALUE_CLOCKWISE
        ];
        return [new Choice(['strict' => true, 'choices' => $values])];
    }
}
