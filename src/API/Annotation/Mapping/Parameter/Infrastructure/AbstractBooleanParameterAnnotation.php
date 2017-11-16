<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure;

abstract class AbstractBooleanParameterAnnotation extends AbstractParameterAnnotation
{
    /**
     * @var bool
     */
    public $value;
}
