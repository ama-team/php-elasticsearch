<?php

namespace AmaTeam\ElasticSearch\API\Mapping;

use AmaTeam\ElasticSearch\API\Mapping\Validation\ContextInterface;
use AmaTeam\ElasticSearch\API\MappingInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface ValidatorInterface
{
    public function validate(
        MappingInterface $mapping,
        ContextInterface $context = null
    ): ConstraintViolationListInterface;
}
