<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexOptionsParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class IndexOptions extends AbstractParameterAnnotation
{
    /**
     * @Enum({
     *     AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexOptionsParameter::VALUE_OFFSETS,
     *     AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexOptionsParameter::VALUE_POSITIONS,
     *     AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexOptionsParameter::VALUE_FREQUENCIES,
     *     AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexOptionsParameter::VALUE_DOCUMENTS
     * })
     * @var string
     */
    public $value;

    public function getParameter(): string
    {
        return IndexOptionsParameter::FRIENDLY_ID;
    }
}
