<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type;

use AmaTeam\ElasticSearch\Mapping\Type\Infrastructure\AbstractType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\RelationsParameter;

class JoinType extends AbstractType
{
    const ID = 'join';
    const FRIENDLY_ID = self::ID;

    public function getId(): string
    {
        return self::ID;
    }

    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return [RelationsParameter::getInstance()];
    }
}
