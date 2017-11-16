<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API;

use Elasticsearch\Client;

interface ClientFactoryInterface
{
    public function getClient(): Client;
}
