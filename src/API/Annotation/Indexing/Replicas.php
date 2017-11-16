<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Indexing;

use AmaTeam\ElasticSearch\API\Annotation\Indexing\Infrastructure\AbstractIntegerOptionAnnotation;
use AmaTeam\ElasticSearch\API\Indexing\OptionInterface;
use AmaTeam\ElasticSearch\Indexing\Option\NumberOfReplicasOption;

/**
 * @Annotation
 * @Target("CLASS")
 */
class Replicas extends AbstractIntegerOptionAnnotation
{
    public function getOption(): OptionInterface
    {
        return NumberOfReplicasOption::getInstance();
    }
}
