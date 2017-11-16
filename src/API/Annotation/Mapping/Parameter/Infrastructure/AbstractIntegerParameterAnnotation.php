<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure;

abstract class AbstractIntegerParameterAnnotation extends AbstractParameterAnnotation
{
    /**
     * @var int
     */
    public $value;
}
