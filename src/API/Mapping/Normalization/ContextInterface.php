<?php

namespace AmaTeam\ElasticSearch\API\Mapping\Normalization;

interface ContextInterface
{
    public function shouldPreserveUnknownParameters(): bool;

    /**
     * Allows to preserve specific set of unknown parameters even if
     * shouldPreserveUnknownParameters returns false.
     *
     * @return string[]
     */
    public function getPreservedParameters(): array;
    public function isRootMapping(): bool;
}
