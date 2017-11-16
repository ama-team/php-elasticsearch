<?php

namespace AmaTeam\ElasticSearch\API;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class DefaultClientFactory implements ClientFactoryInterface
{
    /**
     * @var string[]
     */
    private $hosts;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param string[] $hosts
     */
    public function __construct($hosts = ['localhost:9200'])
    {
        $this->hosts = $hosts;
        $this->logger = new NullLogger();
    }

    public function getClient(): Client
    {
        return ClientBuilder::create()->setHosts($this->hosts)->build();
    }

    /**
     * @param string[] $hosts
     * @return DefaultClientFactory
     */
    public function setHosts(string ...$hosts): DefaultClientFactory
    {
        $this->hosts = $hosts;
        return $this;
    }

    /**
     * @param LoggerInterface $logger
     * @return DefaultClientFactory
     */
    public function setLogger(LoggerInterface $logger): DefaultClientFactory
    {
        $this->logger = $logger;
        return $this;
    }
}
