<?php

namespace AmaTeam\ElasticSearch\API\Indexing\Validation;

interface ContextInterface
{
    /**
     * @return string[]
     */
    public function getPath(): array;
    public function shouldPreserveUnknownOptions(): bool;
}
