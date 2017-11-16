<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Test\Support;

use AmaTeam\ElasticSearch\API\ClientFactoryInterface;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class TestClientFactory implements ClientFactoryInterface
{
    public function getClient(): Client
    {
        $connectionString = getenv('ELASTICSEARCH_CONTACT_POINTS') ?: 'localhost:9200';
        $contactPoints = array_filter(array_map('trim', explode(',', $connectionString)));
        return ClientBuilder::create()->setHosts($contactPoints)->build();
    }
}
