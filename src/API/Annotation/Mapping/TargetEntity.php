<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Infrastructure\ViewAwareAnnotationInterface;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class TargetEntity implements ViewAwareAnnotationInterface
{
    /**
     * @Required
     * @var string
     */
    public $value;

    /**
     * @var array<string>
     */
    public $views;

    /**
     * @return array
     */
    public function getViews(): array
    {
        return $this->views;
    }
}
