<?php

namespace AmaTeam\ElasticSearch;

use AmaTeam\ElasticSearch\API\ClientInterface;
use AmaTeam\ElasticSearch\API\Entity\RegistryInterface;
use AmaTeam\ElasticSearch\API\Framework\ConfigurationInterface;
use AmaTeam\ElasticSearch\API\Framework\OperationsManagerInterface;
use AmaTeam\ElasticSearch\API\FrameworkInterface;
use AmaTeam\ElasticSearch\Entity\Registry;
use AmaTeam\ElasticSearch\Framework\Builder;
use AmaTeam\ElasticSearch\Framework\OperationsManager;

class Framework implements FrameworkInterface
{
    /**
     * @var ConfigurationInterface
     */
    private $configuration;
    /**
     * @var RegistryInterface
     */
    private $manager;

    /**
     * @param Registry $manager
     * @param ConfigurationInterface $configuration
     */
    public function __construct(Registry $manager, ConfigurationInterface $configuration = null)
    {
        $this->manager = $manager;
        $this->configuration = $configuration ?? new Builder();
    }

    public function getRegistry(): RegistryInterface
    {
        return $this->manager;
    }

    public function getClient(): ClientInterface
    {
        return new Client($this->configuration->getClientFactory());
    }

    public function getOperationsManager(): OperationsManagerInterface
    {
        return new OperationsManager($this->getRegistry(), $this->getClient());
    }
}
