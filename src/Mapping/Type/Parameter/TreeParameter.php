<?php

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractParameter;
use Symfony\Component\Validator\Constraints\Choice;

class TreeParameter extends AbstractParameter
{
    const ID = 'tree';
    const FRIENDLY_ID = self::ID;

    const VALUE_GEOHASH = 'geohash';
    const VALUE_QUADTREE = 'quadtree';

    public function getId(): string
    {
        return self::ID;
    }

    public function getConstraints(): array
    {
        $values = [self::VALUE_GEOHASH, self::VALUE_QUADTREE];
        return [new Choice(['strict' => true, 'choices' => $values])];
    }
}
