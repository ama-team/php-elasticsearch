<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Infrastructure;

interface ViewAwareAnnotationInterface
{
    /**
     * @return string[]|null
     */
    public function getViews(): ?array;
}
