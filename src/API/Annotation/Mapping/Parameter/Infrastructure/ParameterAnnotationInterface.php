<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure;

interface ParameterAnnotationInterface
{
    public function getParameter(): string;
    public function getValue();
}
