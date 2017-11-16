<?php

namespace AmaTeam\ElasticSearch\API\Entity;

use AmaTeam\ElasticSearch\API\EntityInterface;

interface NormalizerInterface
{
    public function normalize(EntityInterface $entity): EntityInterface;
}
