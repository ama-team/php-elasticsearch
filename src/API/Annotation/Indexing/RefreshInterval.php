<?php

namespace AmaTeam\ElasticSearch\API\Annotation\Indexing;

use AmaTeam\ElasticSearch\API\Annotation\Indexing\Infrastructure\AbstractOptionAnnotation;
use AmaTeam\ElasticSearch\API\Indexing\OptionInterface;
use AmaTeam\ElasticSearch\Indexing\Option\RefreshIntervalOption;

/**
 * @Annotation
 * @Target("CLASS")
 */
class RefreshInterval extends AbstractOptionAnnotation
{
    public function getOption(): OptionInterface
    {
        return RefreshIntervalOption::getInstance();
    }
}
