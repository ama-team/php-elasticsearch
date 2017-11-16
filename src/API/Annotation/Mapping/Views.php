<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Infrastructure\ViewAwareAnnotationInterface;
use AmaTeam\ElasticSearch\API\Annotation\Mapping\Infrastructure\ViewAwareAnnotationTrait;

/**
 * This annotation allows to enforce specified views on a class
 * specified in property.
 *
 * If mode is specified as APPEND, forced views are appended to list
 * of views, otherwise they replace existing.
 *
 * @Annotation
 * @Target("PROPERTY")
 */
class Views implements ViewAwareAnnotationInterface
{
    use ViewAwareAnnotationTrait;

    const MODE_APPEND = 'APPEND';
    const MODE_REPLACE = 'REPLACE';
    /**
     * @Required
     * @var array<string>
     */
    public $value;

    /**
     * @Enum({"APPEND", "REPLACE"})
     * @var string
     */
    public $mode = self::MODE_APPEND;
}
