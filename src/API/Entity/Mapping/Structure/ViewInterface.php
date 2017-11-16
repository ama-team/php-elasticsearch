<?php

namespace AmaTeam\ElasticSearch\API\Entity\Mapping\Structure;

interface ViewInterface
{
    public function getType(): ?string;
    public function getParameters(): array;

    /**
     * @return string[]
     */
    public function getIgnoredProperties(): array;

    /**
     * @return string[]
     */
    public function getExistingProperties(): array;
}
