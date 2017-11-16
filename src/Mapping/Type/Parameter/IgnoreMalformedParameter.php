<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractBooleanParameter;

class IgnoreMalformedParameter extends AbstractBooleanParameter
{
    const ID = 'ignore_malformed';
    const FRIENDLY_ID = 'ignoreMalformed';

    public function getId(): string
    {
        return self::ID;
    }

    public function getFriendlyId(): string
    {
        return self::FRIENDLY_ID;
    }
}
