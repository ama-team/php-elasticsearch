<?php

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Infrastructure;

trait ViewAwareAnnotationTrait
{
    /**
     * @var array<string>
     */
    public $views;

    /**
     * @return string[]|null
     */
    public function getViews(): ?array
    {
        return $this->views;
    }
}
