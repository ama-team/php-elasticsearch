<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Infrastructure\ViewAwareAnnotationInterface;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class AbstractParameterAnnotation implements ParameterAnnotationInterface, ViewAwareAnnotationInterface
{
    public $value;

    /**
     * @var array<string>
     */
    public $views;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function getViews(): ?array
    {
        return $this->views;
    }
}
