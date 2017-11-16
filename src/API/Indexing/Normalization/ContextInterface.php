<?php

namespace AmaTeam\ElasticSearch\API\Indexing\Normalization;

interface ContextInterface
{
    public function shouldPreserveUnknownOptions(): bool;

    /**
     * @return string[]
     */
    public function getPreservedOptions(): array;
}
