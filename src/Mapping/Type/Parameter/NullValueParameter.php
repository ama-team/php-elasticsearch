<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractParameter;

class NullValueParameter extends AbstractParameter
{
    const ID = 'null_value';
    const FRIENDLY_ID = 'nullValue';

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
        return [];
    }

    /**
     * @inheritDoc
     */
    public function nullValueAllowed(): bool
    {
        return true;
    }
}
