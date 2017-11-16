<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API;

interface MappingInterface
{
    /**
     * @return string
     */
    public function getType(): ?string;

    /**
     * @return array
     */
    public function getParameters(): array;
    public function hasParameter(string $name): bool;
    public function getParameter(string $name);

    /**
     * @return MappingInterface[]
     */
    public function getProperties(): array;
    public function hasProperty(string $name): bool;
    public function getProperty(string $name): ?MappingInterface;
}
