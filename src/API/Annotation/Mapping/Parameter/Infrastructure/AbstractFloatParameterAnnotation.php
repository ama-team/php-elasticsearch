<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure;

abstract class AbstractFloatParameterAnnotation extends AbstractParameterAnnotation
{
    /**
     * @var float
     */
    public $value;
}
