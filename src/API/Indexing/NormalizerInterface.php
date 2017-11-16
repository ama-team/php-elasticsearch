<?php

namespace AmaTeam\ElasticSearch\API\Indexing;

use AmaTeam\ElasticSearch\API\Indexing\Normalization\ContextInterface;
use AmaTeam\ElasticSearch\API\IndexingInterface;

interface NormalizerInterface
{
    public function normalize(IndexingInterface $indexing, ContextInterface $context = null): IndexingInterface;
}
