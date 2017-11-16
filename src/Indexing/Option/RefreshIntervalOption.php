<?php

namespace AmaTeam\ElasticSearch\Indexing\Option;

use AmaTeam\ElasticSearch\Indexing\Option\Infrastructure\AbstractOption;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class RefreshIntervalOption extends AbstractOption
{
    const ID = 'refresh_interval';
    const FRIENDLY_ID = 'refreshInterval';

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
        return [new Type('string'), new NotBlank()];
    }
}
