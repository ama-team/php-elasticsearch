<?php

namespace AmaTeam\ElasticSearch\API\Indexing;

use AmaTeam\ElasticSearch\API\Indexing\Validation\ContextInterface;
use AmaTeam\ElasticSearch\API\IndexingInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface ValidatorInterface
{
    public function validate(
        IndexingInterface $indexing,
        ContextInterface $context = null
    ): ConstraintViolationListInterface;
}
