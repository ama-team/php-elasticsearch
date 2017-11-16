<?php

namespace AmaTeam\ElasticSearch\API\Annotation\Indexing;

use AmaTeam\ElasticSearch\API\Annotation\Indexing\Infrastructure\AbstractOptionAnnotation;
use AmaTeam\ElasticSearch\API\Indexing\OptionInterface;
use AmaTeam\ElasticSearch\Indexing\Option\NumberOfShardsOption;

/**
 * @Annotation
 * @Target("CLASS")
 */
class Shards extends AbstractOptionAnnotation
{
    public function getOption(): OptionInterface
    {
        return NumberOfShardsOption::getInstance();
    }
}
