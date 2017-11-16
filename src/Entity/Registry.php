<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Entity;

use AmaTeam\ElasticSearch\API\Entity\Loader\Context;
use AmaTeam\ElasticSearch\API\Entity\Loader\ContextInterface;
use AmaTeam\ElasticSearch\API\Entity\LoaderInterface;
use AmaTeam\ElasticSearch\API\EntityInterface;
use AmaTeam\ElasticSearch\API\Entity\RegistryInterface;
use BadMethodCallException;

class Registry implements RegistryInterface
{
    /**
     * @var LoaderInterface
     */
    private $loader;
    /**
     * @var ContextInterface
     */
    private $context;
    /**
     * @var EntityInterface[]
     */
    private $registry = [];

    /**
     * @param LoaderInterface $loader
     * @param ContextInterface|null $context
     */
    public function __construct(LoaderInterface $loader, ContextInterface $context = null)
    {
        $this->context = $context ?? new Context();
        $this->loader = $loader;
    }

    public function get(string $name): EntityInterface
    {
        $entity = $this->find($name);
        if ($entity) {
            return $entity;
        }
        throw new BadMethodCallException("Can't get entity for class `$name`");
    }

    public function find(string $name): ?EntityInterface
    {
        if (isset($this->registry[$name])) {
            return $this->registry[$name];
        }
        $entity = $this->loader->load($name, $this->context);
        if (!$entity) {
            return null;
        }
        $this->registry[$name] = $entity;
        return $entity;
    }

    public function exists(string $name): bool
    {
        return isset($this->registry[$name]) || $this->loader->exists($name);
    }
}
