<?php

namespace AmaTeam\ElasticSearch\API\Mapping;

use AmaTeam\ElasticSearch\API\Mapping\Normalization\ContextInterface;
use AmaTeam\ElasticSearch\API\MappingInterface;

interface NormalizerInterface
{
    public function normalize(MappingInterface $mapping, ContextInterface $context = null): MappingInterface;
}
