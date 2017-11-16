<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Entity\Annotation;

use AmaTeam\ElasticSearch\Entity\Annotation\Listener\EntityAnnotationListener;
use AmaTeam\ElasticSearch\Entity\Annotation\Listener\Indexing\ParameterAnnotationListener;
use AmaTeam\ElasticSearch\Entity\Annotation\Listener\Mapping\Clazz\StructureParameterAnnotationListener;
use AmaTeam\ElasticSearch\Entity\Annotation\Listener\Mapping\Clazz\StructureTypeAnnotationListener;
use AmaTeam\ElasticSearch\Entity\Annotation\Listener\Mapping\Clazz\IgnoredParentPropertiesAnnotationListener;
use AmaTeam\ElasticSearch\Entity\Annotation\Listener\Mapping\Property\IgnoredPropertyAnnotationListener;
use AmaTeam\ElasticSearch\Entity\Annotation\Listener\Mapping\Property\ViewsAnnotationListener;
use AmaTeam\ElasticSearch\Entity\Annotation\Listener\Mapping\Property\ParameterPropertyAnnotationListener;
use AmaTeam\ElasticSearch\Entity\Annotation\Listener\Mapping\Property\TargetEntityAnnotationListener;
use AmaTeam\ElasticSearch\Entity\Annotation\Listener\Mapping\Property\TypePropertyAnnotationListener;

/**
 * Silly direct dependency decoupling
 */
class ListenerProvider
{
    public static function getClassListeners(): array
    {
        return [
            new EntityAnnotationListener(),
            new StructureParameterAnnotationListener(),
            new StructureTypeAnnotationListener(),
            new IgnoredParentPropertiesAnnotationListener(),
            new ParameterAnnotationListener(),
        ];
    }

    public static function getPropertyListeners(): array
    {
        return [
            new TargetEntityAnnotationListener(),
            new TypePropertyAnnotationListener(),
            new ParameterPropertyAnnotationListener(),
            new ViewsAnnotationListener(),
            new IgnoredPropertyAnnotationListener(),
        ];
    }
}
