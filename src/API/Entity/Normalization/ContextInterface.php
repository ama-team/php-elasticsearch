<?php

namespace AmaTeam\ElasticSearch\API\Entity\Normalization;

interface ContextInterface
{
    public function shouldPreserveUnknownEntries(): bool;
    public function getPreservedIndexingOptions(): array;
    public function getPreservedMappingParameters(): array;
}
