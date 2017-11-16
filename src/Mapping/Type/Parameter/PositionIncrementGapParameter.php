<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractIntegerParameter;

class PositionIncrementGapParameter extends AbstractIntegerParameter
{
    const ID = 'position_increment_gap';
    const FRIENDLY_ID = 'positionIncrementGap';

    public function getId(): string
    {
        return self::ID;
    }

    public function getFriendlyId(): string
    {
        return self::FRIENDLY_ID;
    }
}
