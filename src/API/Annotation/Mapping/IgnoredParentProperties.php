<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping;

/**
 * This annotation allows end user to hide specific properties from
 * parent class mapping as if they were never defined, so current class
 * (the one with this annotation) may have complete control over such
 * properties.
 *
 * @Annotation
 * @Target("CLASS")
 */
class IgnoredParentProperties
{
    /**
     * @Required
     * @var array<string>
     */
    public $value;
}
