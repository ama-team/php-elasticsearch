<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractParameter;

class FieldsParameter extends AbstractParameter
{
    const ID = 'fields';
    const FRIENDLY_ID = self::ID;

    public function getId(): string
    {
        return self::ID;
    }

    /**
     * @inheritDoc
     */
    public function getConstraints(): array
    {
        // TODO: add proper constraints
        return [];
    }
}
