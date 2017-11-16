<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Infrastructure\ViewAwareAnnotationInterface;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class IgnoredProperty implements ViewAwareAnnotationInterface
{
    /**
     * @var array<string>
     */
    public $views;

    /**
     * @return string[]
     */
    public function getViews(): array
    {
        return $this->views;
    }
}
