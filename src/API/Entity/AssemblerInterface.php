<?php

namespace AmaTeam\ElasticSearch\API\Entity;

use AmaTeam\ElasticSearch\API\EntityInterface;

interface AssemblerInterface
{
    public function assemble(DescriptorInterface $descriptor): EntityInterface;
}
