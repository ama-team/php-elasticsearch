<?php

namespace AmaTeam\ElasticSearch\API\Entity\Validation;

interface ContextInterface
{
    public function shouldPreserveUnknownEntries(): bool;
    public function getPreservedIndexingOptions(): array;
    public function getPreservedMappingParameters(): array;
}
