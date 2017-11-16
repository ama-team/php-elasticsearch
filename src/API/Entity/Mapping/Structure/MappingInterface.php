<?php

namespace AmaTeam\ElasticSearch\API\Entity\Mapping\Structure;

use AmaTeam\ElasticSearch\API\Entity\Mapping\Property\MappingInterface as PropertyMappingInterface;

interface MappingInterface
{
    public function getDefaultView(): ViewInterface;

    /**
     * @return ViewInterface[]
     */
    public function getViews(): array;

    /**
     * @return string[]|null
     */
    public function getIgnoredParentProperties(): ?array;

    /**
     * @return PropertyMappingInterface[]
     */
    public function getProperties(): array;
}
