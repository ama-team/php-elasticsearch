<?php

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Infrastructure;

interface TypeAnnotationInterface extends ViewAwareAnnotationInterface
{
    public function getValue(): string;
}
