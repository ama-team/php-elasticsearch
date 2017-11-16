<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractEnumParameter;

class TermVectorParameter extends AbstractEnumParameter
{
    const ID = 'term_vector';
    const FRIENDLY_ID = 'termVector';

    const VALUE_NO = 'no';
    const VALUE_YES = 'yes';
    const VALUE_WITH_POSITIONS = 'with_positions';
    const VALUE_WITH_OFFSETS = 'with_offsets';
    const VALUE_WITH_POSITIONS_AND_OFFSETS = 'with_position_offsets';

    public function getId(): string
    {
        return self::ID;
    }

    public function getFriendlyId(): string
    {
        return self::FRIENDLY_ID;
    }

    public function getAllowedValues()
    {
        return [
            self::VALUE_NO,
            self::VALUE_YES,
            self::VALUE_WITH_POSITIONS,
            self::VALUE_WITH_OFFSETS,
            self::VALUE_WITH_POSITIONS_AND_OFFSETS
        ];
    }
}
