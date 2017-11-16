<?php

namespace AmaTeam\ElasticSearch\Indexing\Option;

use AmaTeam\ElasticSearch\Indexing\Option\Infrastructure\AbstractOption;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Type;

class NumberOfShardsOption extends AbstractOption
{
    const ID = 'number_of_shards';
    const FRIENDLY_ID = 'numberOfShards';

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
        return [new Type('integer'), new GreaterThan(0)];
    }
}
