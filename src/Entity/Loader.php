<?php

namespace AmaTeam\ElasticSearch\Entity;

use AmaTeam\ElasticSearch\API\Entity\AssemblerInterface;
use AmaTeam\ElasticSearch\API\Entity\Descriptor\ManagerInterface;
use AmaTeam\ElasticSearch\API\Entity\Loader\Context;
use AmaTeam\ElasticSearch\API\Entity\Loader\ContextInterface;
use AmaTeam\ElasticSearch\API\Entity\LoaderInterface;
use AmaTeam\ElasticSearch\API\Entity\NormalizerInterface;
use AmaTeam\ElasticSearch\API\Entity\ValidatorInterface;
use AmaTeam\ElasticSearch\API\EntityInterface;
use AmaTeam\ElasticSearch\API\Entity\Validation\ValidationException;

class Loader implements LoaderInterface
{
    /**
     * @var ManagerInterface
     */
    private $manager;
    /**
     * @var AssemblerInterface
     */
    private $assembler;
    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var NormalizerInterface
     */
    private $normalizer;

    /**
     * @param ManagerInterface $manager
     * @param AssemblerInterface|null $assembler
     * @param ValidatorInterface|null $validator
     * @param NormalizerInterface|null $normalizer
     */
    public function __construct(
        ManagerInterface $manager,
        AssemblerInterface $assembler = null,
        ValidatorInterface $validator = null,
        NormalizerInterface $normalizer = null
    ) {
        $this->manager = $manager;
        $this->assembler = $assembler ?? new Assembler($manager);
        $this->validator = $validator ?? new Validator();
        $this->normalizer = $normalizer ?? new Normalizer();
    }


    public function load(string $name, ContextInterface $context = null): ?EntityInterface
    {
        $descriptor = $this->manager->find($name);
        if (!$descriptor) {
            return null;
        }
        $context = $context ?? new Context();
        $entity = $this->assembler->assemble($descriptor);
        $entity = $this->normalize($entity, $context);
        $this->validate($entity, $context);
        return $entity;
    }

    private function normalize(EntityInterface $entity, ContextInterface $context): EntityInterface
    {
        if (!$context->shouldNormalize()) {
            return $entity;
        }
        return $this->normalizer->normalize($entity, $context);
    }

    private function validate(EntityInterface $entity, ContextInterface $context): void
    {
        if (!$context->shouldValidate()) {
            return;
        }
        $violations = $this->validator->validate($entity, $context);
        if ($violations->count() === 0) {
            return;
        }
        $lines = [sprintf('Entity metadata `%s` has failed validation:', $entity->getName())];
        foreach ($violations as $violation) {
            $lines[] = $violation->getPropertyPath() . ': ' . $violation->getMessage();
        }
        throw new ValidationException(implode(PHP_EOL, $lines), $violations);
    }

    public function exists(string $name): bool
    {
        return $this->manager->exists($name);
    }
}
