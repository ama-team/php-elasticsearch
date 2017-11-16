<?php

namespace AmaTeam\ElasticSearch\API;

use AmaTeam\ElasticSearch\API\Entity\RegistryInterface;
use AmaTeam\ElasticSearch\API\Framework\OperationsManagerInterface;

interface FrameworkInterface
{
    public function getRegistry(): RegistryInterface;
    public function getClient(): ClientInterface;
    public function getOperationsManager(): OperationsManagerInterface;
}
