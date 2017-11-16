<?php

namespace AmaTeam\ElasticSearch\API\Entity;

use AmaTeam\ElasticSearch\API\Entity\Validation\ContextInterface;
use AmaTeam\ElasticSearch\API\EntityInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface ValidatorInterface
{
    public function validate(
        EntityInterface $entity,
        ContextInterface $context = null
    ): ConstraintViolationListInterface;
}
