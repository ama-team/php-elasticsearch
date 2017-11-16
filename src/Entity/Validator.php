<?php

namespace AmaTeam\ElasticSearch\Entity;

use AmaTeam\ElasticSearch\API\Entity\Validation\Context;
use AmaTeam\ElasticSearch\API\Entity\Validation\ContextInterface;
use AmaTeam\ElasticSearch\API\Entity\ValidatorInterface;
use AmaTeam\ElasticSearch\API\EntityInterface;
use AmaTeam\ElasticSearch\API\Indexing\Validation\Context as IndexingContext;
use AmaTeam\ElasticSearch\API\Indexing\ValidatorInterface as IndexingValidatorInterface;
use AmaTeam\ElasticSearch\API\IndexingInterface;
use AmaTeam\ElasticSearch\API\Mapping\Validation\Context as MappingContext;
use AmaTeam\ElasticSearch\API\Mapping\ValidatorInterface as MappingValidatorInterface;
use AmaTeam\ElasticSearch\API\MappingInterface;
use AmaTeam\ElasticSearch\Indexing\Validator as IndexingValidator;
use AmaTeam\ElasticSearch\Mapping\Validator as MappingValidator;
use AmaTeam\ElasticSearch\Utility\Violations;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class Validator implements ValidatorInterface
{
    /**
     * @var MappingValidatorInterface
     */
    private $mappingValidator;
    /**
     * @var IndexingValidatorInterface
     */
    private $indexingValidator;

    public function __construct()
    {
        $this->mappingValidator = new MappingValidator();
        $this->indexingValidator = new IndexingValidator();
    }

    public function validate(
        EntityInterface $entity,
        ContextInterface $context = null
    ): ConstraintViolationListInterface {
        $violations = [];
        $context = $context ?? new Context();
        foreach ($this->validateMapping($entity->getMapping(), $context) as $violation) {
            $violations[] = Violations::remap($violation, $entity, 'mapping');
        }
        foreach ($this->validateIndexing($entity->getIndexing(), $context) as $violation) {
            $violations[] = Violations::remap($violation, $entity, 'indexing');
        }
        return new ConstraintViolationList($violations);
    }

    private function validateMapping(
        MappingInterface $mapping,
        ContextInterface $context
    ): ConstraintViolationListInterface {
        $configuration = (new MappingContext())
            ->setPreserveUnknownParameters($context->shouldPreserveUnknownEntries());
        return $this->mappingValidator->validate($mapping, $configuration);
    }

    private function validateIndexing(
        IndexingInterface $indexing,
        ContextInterface $context
    ): ConstraintViolationListInterface {
        $configuration = (new IndexingContext())
            ->setPreserveUnknownEntries($context->shouldPreserveUnknownEntries());
        return $this->indexingValidator->validate($indexing, $configuration);
    }
}
