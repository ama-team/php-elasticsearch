<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation;

/**
 * @Annotation
 * @Target("CLASS")
 */
class Document extends Embeddable
{
    /**
     * @var array<string>
     */
    public $writeIndices = [];
    /**
     * @var array<string>
     */
    public $readIndices = [];
    /**
     * @var string
     */
    public $type = 'doc';
}
