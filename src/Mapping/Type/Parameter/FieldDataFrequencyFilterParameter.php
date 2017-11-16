<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractFloatParameter;

class FieldDataFrequencyFilterParameter extends AbstractFloatParameter
{
    const ID = 'fielddata_frequency_filter';
    const FRIENDLY_ID = 'fieldDataFrequencyFilter';

    public function getId(): string
    {
        return self::ID;
    }

    public function getFriendlyId(): string
    {
        return self::FRIENDLY_ID;
    }
}
