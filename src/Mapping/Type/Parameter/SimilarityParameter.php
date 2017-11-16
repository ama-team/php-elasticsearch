<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractBooleanParameter;

class SimilarityParameter extends AbstractBooleanParameter
{
    const ID = 'similarity';
    const FRIENDLY_ID = self::ID;

    public function getId(): string
    {
        return self::ID;
    }
}
