<?php

namespace AmaTeam\ElasticSearch\Framework;

use AmaTeam\ElasticSearch\API\ClientInterface;
use AmaTeam\ElasticSearch\API\Entity\RegistryInterface;
use AmaTeam\ElasticSearch\API\Framework\OperationsManagerInterface;

class OperationsManager implements OperationsManagerInterface
{
    /**
     * @var RegistryInterface
     */
    private $registry;
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param RegistryInterface $registry
     * @param ClientInterface $client
     */
    public function __construct(RegistryInterface $registry, ClientInterface $client)
    {
        $this->registry = $registry;
        $this->client = $client;
    }

    public function setUp(string $entityName): void
    {
        $entity = $this->registry->get($entityName);
        $api = $this->client->indices();
        foreach ($entity->getIndexing()->getWriteIndices() as $index) {
            $type = $entity->getIndexing()->getType();
            if ($api->exists($index)) {
                $api->setMapping($index, $type, $entity->getMapping());
                continue;
            }
            $mappings = [$type => $entity->getMapping()];
            $api->create($index, $entity->getIndexing(), $mappings);
        }
    }
}
