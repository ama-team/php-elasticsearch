<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractRangeType;

class DoubleRangeType extends AbstractRangeType
{
    const ID = 'double_range';
    const FRIENDLY_ID = 'doubleRange';

    public function getId(): string
    {
        return self::ID;
    }

    public function getFriendlyId(): string
    {
        return self::FRIENDLY_ID;
    }
}
