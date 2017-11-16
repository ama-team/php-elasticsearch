<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Indexing\Infrastructure;

abstract class AbstractIntegerOptionAnnotation extends AbstractOptionAnnotation
{
    /**
     * @var int
     */
    public $value;
}
