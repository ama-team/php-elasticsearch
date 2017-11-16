<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Mapping;

use AmaTeam\ElasticSearch\API\Mapping\Type\ParameterInterface;

interface TypeInterface
{
    public function getId(): string;
    public function getFriendlyId(): string;

    /**
     * @return ParameterInterface[]
     */
    public function getParameters(): array;
}
