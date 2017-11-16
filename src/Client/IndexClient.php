<?php

namespace AmaTeam\ElasticSearch\Client;

use AmaTeam\ElasticSearch\API\Client\IndexClientInterface;
use AmaTeam\ElasticSearch\API\IndexingInterface;
use AmaTeam\ElasticSearch\API\MappingInterface;
use AmaTeam\ElasticSearch\Mapping\Operations as Mappings;
use AmaTeam\ElasticSearch\Mapping\Type\RootType;
use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\Missing404Exception;

class IndexClient implements IndexClientInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function create(string $index, IndexingInterface $indexing = null, array $mappings = []): void
    {
        $payload = ['settings' => $indexing->getOptions(), 'mappings' => []];
        foreach ($mappings as $type => $mapping) {
            $normalized = Mappings::toStdObject($mapping);
            unset($normalized->type);
            $payload['mappings'][$type] = $normalized;
        }
        foreach ($payload as $key => $value) {
            if (empty($value)) {
                unset($payload[$key]);
            }
        }
        $parameters = ['index' => $index, 'body' => $payload];
        $this->client->indices()->create($parameters);
    }

    public function exists(string $index): bool
    {
        return $this->client->indices()->exists(['index' => $index]);
    }

    public function delete(string $index): void
    {
        try {
            $this->client->delete(['index' => $index]);
        } catch (Missing404Exception $e) {
            // noop
        }
    }

    public function setMapping(string $index, string $type, MappingInterface $mapping): void
    {
        $payload = Mappings::toStdObject($mapping);
        unset($payload->type);
        $parameters = ['index' => $index, 'type' => $type, 'body' => $payload];
        $this->client->indices()->putMapping($parameters);
    }

    public function getMapping(string $index, string $type): ?MappingInterface
    {
        $data = $this->client->indices()->getMapping(['index' => $index, 'type' => $type]);
        $normalized = $data[$index]['mappings'][$type];
        $mapping = Mappings::fromArray($normalized);
        $mapping->setType(RootType::ID);
        return $mapping;
    }

    public function setIndexing(string $index, IndexingInterface $indexing): void
    {
        $parameters = ['index' => $index, 'body' => $indexing->getOptions()];
        $this->client->indices()->putSettings($parameters);
    }
}
