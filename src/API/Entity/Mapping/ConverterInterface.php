<?php

namespace AmaTeam\ElasticSearch\API\Entity\Mapping;

use AmaTeam\ElasticSearch\API\Entity\Mapping\Conversion\ContextInterface;
use AmaTeam\ElasticSearch\API\MappingInterface;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Structure\MappingInterface as StructureMappingInterface;

interface ConverterInterface
{
    public function convert(StructureMappingInterface $mapping, ContextInterface $context = null): MappingInterface;
}
