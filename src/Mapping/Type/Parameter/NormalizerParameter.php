<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractStringParameter;

class NormalizerParameter extends AbstractStringParameter
{
    const ID = 'normalizer';
    const FRIENDLY_ID = self::ID;

    public function getId(): string
    {
        return self::ID;
    }

    /**
     * @inheritDoc
     */
    public function nullValueAllowed(): bool
    {
        return true;
    }
}
