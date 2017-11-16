<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractEnumParameter;

class IndexOptionsParameter extends AbstractEnumParameter
{
    const ID = 'index_options';
    const FRIENDLY_ID = 'indexOptions';

    const VALUE_DOCUMENTS = 'docs';
    const VALUE_FREQUENCIES = 'freqs';
    const VALUE_POSITIONS = 'positions';
    const VALUE_OFFSETS = 'offsets';

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
        return [self::VALUE_DOCUMENTS, self::VALUE_FREQUENCIES, self::VALUE_POSITIONS, self::VALUE_OFFSETS];
    }
}
