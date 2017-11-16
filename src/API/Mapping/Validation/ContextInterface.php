<?php

namespace AmaTeam\ElasticSearch\API\Mapping\Validation;

interface ContextInterface
{
    public function shouldPreserveUnknownParameters(): bool;

    /**
     * @return string[]
     */
    public function getPath(): array;
}
