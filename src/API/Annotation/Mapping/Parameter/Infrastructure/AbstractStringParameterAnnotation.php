<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure;

abstract class AbstractStringParameterAnnotation extends AbstractParameterAnnotation
{
    /**
     * @var string
     */
    public $value;
}
