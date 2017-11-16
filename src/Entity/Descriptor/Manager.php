<?php

namespace AmaTeam\ElasticSearch\Entity\Descriptor;

use AmaTeam\ElasticSearch\API\Entity\Descriptor\LoaderInterface;
use AmaTeam\ElasticSearch\API\Entity\Descriptor\ManagerInterface;
use AmaTeam\ElasticSearch\API\Entity\Descriptor\RegistryInterface;
use AmaTeam\ElasticSearch\API\Entity\DescriptorInterface;
use AmaTeam\ElasticSearch\Utility\Arrays;
use BadMethodCallException;

class Manager implements ManagerInterface
{
    /**
     * @var RegistryInterface
     */
    private $registry;
    /**
     * @var LoaderInterface[]
     */
    private $loaders = [];

    /**
     * @param RegistryInterface $registry
     * @param LoaderInterface[] $loaders
     */
    public function __construct(RegistryInterface $registry = null, array $loaders = [])
    {
        $this->registry = $registry ?: new Registry;
        $this->loaders = $loaders;
    }

    public function get(string $name): DescriptorInterface
    {
        $descriptor = $this->find($name);
        if ($descriptor) {
            return $descriptor;
        }
        $message = "Couldn't find metadata descriptor for id `$name`";
        throw new BadMethodCallException($message);
    }

    public function find(string $name): ?DescriptorInterface
    {
        if ($this->registry->has($name)) {
            return $this->registry->get($name);
        }
        foreach ($this->loaders as $loader) {
            $descriptor = $loader->load($name);
            if ($descriptor) {
                $this->registry->register($descriptor);
                return $descriptor;
            }
        }
        return null;
    }

    public function exists(string $name): bool
    {
        if ($this->registry->has($name)) {
            return true;
        }
        foreach ($this->loaders as $loader) {
            if ($loader->exists($name)) {
                return true;
            }
        }
        return false;
    }

    public function registerLoader(LoaderInterface $loader): Manager
    {
        $this->deregisterLoader($loader);
        $this->loaders[] = $loader;
        return $this;
    }

    public function deregisterLoader(LoaderInterface $loader): Manager
    {
        $this->loaders = Arrays::remove($this->loaders, $loader);
        return $this;
    }
}
