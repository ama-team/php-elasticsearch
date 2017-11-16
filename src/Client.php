<?php

namespace AmaTeam\ElasticSearch;

use AmaTeam\ElasticSearch\API\Client\IndexClientInterface;
use AmaTeam\ElasticSearch\API\ClientFactoryInterface;
use AmaTeam\ElasticSearch\API\ClientInterface;
use AmaTeam\ElasticSearch\Client\IndexClient;

class Client implements ClientInterface
{
    /**
     * @var ClientFactoryInterface
     */
    private $clientFactory;

    /**
     * @param ClientFactoryInterface $clientFactory
     */
    public function __construct(ClientFactoryInterface $clientFactory)
    {
        $this->clientFactory = $clientFactory;
    }

    public function indices(): IndexClientInterface
    {
        return new IndexClient($this->clientFactory->getClient());
    }
}
