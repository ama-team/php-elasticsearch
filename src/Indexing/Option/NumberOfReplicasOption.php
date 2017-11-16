<?php

namespace AmaTeam\ElasticSearch\Indexing\Option;

use AmaTeam\ElasticSearch\Indexing\Option\Infrastructure\AbstractOption;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Type;

class NumberOfReplicasOption extends AbstractOption
{
    const ID = 'number_of_replicas';
    const FRIENDLY_ID = 'numberOfReplicas';

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
        return [new Type('integer'), new GreaterThanOrEqual(0)];
    }
}
