<?php

namespace AmaTeam\ElasticSearch\API\Entity\Mapping\Conversion;

interface ContextInterface
{
    public function getViews(): array;
    public function isRootLevelMapping(): bool;
}
