<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Entity\Annotation;

use AmaTeam\ElasticSearch\API\Entity\Descriptor;
use ReflectionClass;

interface StructureAnnotationListenerInterface
{
    public function accept(ReflectionClass $reflection, Descriptor $descriptor, $annotation): void;
}
