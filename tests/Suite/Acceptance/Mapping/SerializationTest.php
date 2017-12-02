<?php

namespace AmaTeam\ElasticSearch\Test\Suite\Acceptance\Mapping;

use AmaTeam\ElasticSearch\API\Mapping;
use AmaTeam\ElasticSearch\API\MappingInterface;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DocValuesParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DynamicParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexParameter;
use AmaTeam\ElasticSearch\Mapping\Type\RootType;
use Codeception\Test\Unit;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\Assert;

class SerializationTest extends Unit
{
    public function dataProvider()
    {
        return [
            [
                (new Mapping(RootType::ID))
                    ->setParameter(DynamicParameter::ID, false)
                    ->setProperty(
                        'title',
                        (new Mapping())
                            ->setParameter(DocValuesParameter::ID, false)
                            ->setParameter(IndexParameter::ID, false)
                    )
            ]
        ];
    }

    /**
     * @param MappingInterface $mapping
     *
     * @test
     * @dataProvider dataProvider
     */
    public function shouldSerializeAndDeserialize(MappingInterface $mapping)
    {
        $serializer = (new SerializerBuilder())->build();
        $serialized = $serializer->serialize($mapping, 'json');
        $deserialized = $serializer->deserialize($serialized, Mapping::class, 'json');
        Assert::assertEquals($mapping, $deserialized);
    }
}
