<?php

namespace AmaTeam\ElasticSearch\API\Annotation;

use Doctrine\Common\Annotations\Annotation\Required;

/**
 * @Annotation
 * @Target("CLASS")
 */
class Parents
{
    /**
     * @Required()
     * @var array<string>
     */
    public $value = [];
}
