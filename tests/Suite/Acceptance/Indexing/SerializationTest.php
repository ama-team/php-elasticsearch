<?php

namespace AmaTeam\ElasticSearch\Test\Suite\Acceptance\Indexing;

use AmaTeam\ElasticSearch\API\Indexing;
use AmaTeam\ElasticSearch\API\IndexingInterface;
use AmaTeam\ElasticSearch\Indexing\Option\NumberOfReplicasOption;
use AmaTeam\ElasticSearch\Indexing\Option\NumberOfShardsOption;
use Codeception\Test\Unit;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\Assert;

class SerializationTest extends Unit
{
    public function dataProvider()
    {
        return [
            [
                (new Indexing())
                    ->setReadIndices(['alpha', 'beta'])
                    ->setWriteIndices(['beta'])
                    ->setType('doc')
                    ->setOption(NumberOfReplicasOption::ID, 1)
                    ->setOption(NumberOfShardsOption::ID, 1)
            ]
        ];
    }

    /**
     * @param IndexingInterface $indexing
     *
     * @test
     * @dataProvider dataProvider
     */
    public function shouldSerializeAndDeserialize(IndexingInterface $indexing)
    {
        $serializer = (new SerializerBuilder())->build();
        $serialized = $serializer->serialize($indexing, 'json');
        $deserialized = $serializer->deserialize($serialized, Indexing::class, 'json');
        Assert::assertEquals($indexing, $deserialized);
    }
}
