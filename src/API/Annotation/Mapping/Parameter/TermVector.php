<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\TermVectorParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class TermVector extends AbstractParameterAnnotation
{
    /**
     * @Enum({
     *     AmaTeam\ElasticSearch\Mapping\Type\Parameter\TermVectorParameter::VALUE_NO,
     *     AmaTeam\ElasticSearch\Mapping\Type\Parameter\TermVectorParameter::VALUE_YES,
     *     AmaTeam\ElasticSearch\Mapping\Type\Parameter\TermVectorParameter::VALUE_WITH_OFFSETS,
     *     AmaTeam\ElasticSearch\Mapping\Type\Parameter\TermVectorParameter::VALUE_WITH_POSITIONS,
     *     AmaTeam\ElasticSearch\Mapping\Type\Parameter\TermVectorParameter::VALUE_WITH_POSITIONS_AND_OFFSETS
     * })
     * @var string
     */
    public $value;

    public function getParameter(): string
    {
        return TermVectorParameter::FRIENDLY_ID;
    }
}
