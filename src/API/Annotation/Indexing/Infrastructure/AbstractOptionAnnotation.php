<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Indexing\Infrastructure;

abstract class AbstractOptionAnnotation implements OptionAnnotationInterface
{
    public $value;

    public function getValue()
    {
        return $this->value;
    }
}
