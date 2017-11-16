<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Entity\Annotation;

use AmaTeam\ElasticSearch\API\Entity\Descriptor;
use ReflectionProperty;

interface PropertyAnnotationListenerInterface
{
    public function accept(ReflectionProperty $property, Descriptor $descriptor, $annotation): void;
}
