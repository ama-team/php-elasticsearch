<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Infrastructure\TypeAnnotationInterface;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class Type implements TypeAnnotationInterface
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

    public function getValue(): string
    {
        return $this->value;
    }
}
