<?php

namespace AmaTeam\ElasticSearch\API\Entity\Mapping\Property;

interface MappingInterface
{
    public function getName(): string;
    public function getOriginalName(): string;
    public function getDefaultView(): ViewInterface;

    /**
     * @return ViewInterface[]
     */
    public function getViews(): array;
}
