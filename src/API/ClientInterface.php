<?php

namespace AmaTeam\ElasticSearch\API;

use AmaTeam\ElasticSearch\API\Client\IndexClientInterface;

interface ClientInterface
{
    public function indices(): IndexClientInterface;
}
