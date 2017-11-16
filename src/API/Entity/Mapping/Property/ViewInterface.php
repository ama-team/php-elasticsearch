<?php

namespace AmaTeam\ElasticSearch\API\Entity\Mapping\Property;

interface ViewInterface
{
    /**
     * It's just a view, so it may define parameters only and it's okay
     * to not to have a type.
     *
     * @return null|string
     */
    public function getType(): ?string;
    public function getParameters(): array;
    public function getTargetEntity(): ?string;

    /**
     * @return string[]|null
     */
    public function getChildViews(): ?array;
    public function shouldAppendChildViews(): bool;
}
