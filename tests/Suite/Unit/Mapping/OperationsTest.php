<?php

namespace AmaTeam\ElasticSearch\Test\Suite\Unit\Mapping;

use AmaTeam\ElasticSearch\API\Mapping;
use AmaTeam\ElasticSearch\Mapping\Operations;
use AmaTeam\ElasticSearch\Mapping\Type\BooleanType;
use AmaTeam\ElasticSearch\Mapping\Type\FloatType;
use AmaTeam\ElasticSearch\Mapping\Type\IntegerType;
use AmaTeam\ElasticSearch\Mapping\Type\KeywordType;
use AmaTeam\ElasticSearch\Mapping\Type\ObjectType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\AnalyzerParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DocValuesParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DynamicParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NormsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\RootType;
use AmaTeam\ElasticSearch\Mapping\Type\TextType;
use Codeception\Test\Unit;
use PHPUnit\Framework\Assert;

class OperationsTest extends Unit
{
    public function conflictDataProvider()
    {
        return [
            [
                [
                    new Mapping(RootType::ID),
                    new Mapping(ObjectType::ID)
                ],
                true
            ],
            [
                [
                    (new Mapping(RootType::ID))->setParameter(DynamicParameter::ID, true),
                    (new Mapping(RootType::ID))->setParameter(DynamicParameter::ID, false),
                ],
                true
            ],
            [
                [
                    (new Mapping(RootType::ID))->setProperty('value', new Mapping(IntegerType::ID)),
                    (new Mapping(RootType::ID))->setProperty('value', new Mapping(FloatType::ID)),
                ],
                true
            ],
            [
                [
                    (new Mapping(RootType::ID))
                        ->setProperty('alpha', new Mapping(IntegerType::ID))
                        ->setParameter(IndexParameter::ID, false),
                    (new Mapping(RootType::ID))
                        ->setProperty('beta', new Mapping(ObjectType::ID))
                        ->setParameter(DynamicParameter::ID, true),
                    (new Mapping(RootType::ID))
                        ->setProperty('gamma', new Mapping(KeywordType::ID))
                        ->setParameter(NormsParameter::ID, true)
                ],
                false
            ]
        ];
    }

    /**
     * @param array $mappings
     * @param bool $expectation
     *
     * @test
     * @dataProvider conflictDataProvider
     */
    public function shouldCorrectlyFindConflicts(array $mappings, bool $expectation)
    {
        $result = Operations::conflict(...$mappings);
        Assert::assertEquals($expectation, $result);
    }

    public function fromArrayDataProvider()
    {
        return [
            [
                [
                    'dynamic' => 'strict',
                    'properties' => [
                        'id' => [
                            'type' => 'integer',
                            'index' => false,
                        ],
                        'title' => [
                            'type' => 'text',
                            'analyzer' => 'title',
                        ],
                        'category' => [
                            'type' => 'keyword',
                            'doc_values' => true,
                        ],
                        'aspects' => [
                            'type' => 'object',
                            'dynamic' => 'true',
                            'properties' => [
                                'comfortable' => ['type' => 'boolean'],
                                'cheap' => ['type' => 'boolean'],
                            ]
                        ]
                    ]
                ],
                (new Mapping())
                    ->setParameter(DynamicParameter::ID, DynamicParameter::VALUE_STRICT)
                    ->setProperties([
                        'id' => (new Mapping(IntegerType::ID))->setParameter(IndexParameter::ID, false),
                        'title' => (new Mapping(TextType::ID))->setParameter(AnalyzerParameter::ID, 'title'),
                        'category' => (new Mapping(KeywordType::ID))->setParameter(DocValuesParameter::ID, true),
                        'aspects' => (new Mapping(ObjectType::ID))
                            ->setParameter(DynamicParameter::ID, DynamicParameter::VALUE_TRUE)
                            ->setProperty('comfortable', new Mapping(BooleanType::ID))
                            ->setProperty('cheap', new Mapping(BooleanType::ID))
                    ])
            ]
        ];
    }

    /**
     * @param array $input
     * @param Mapping $expectation
     *
     * @test
     * @dataProvider fromArrayDataProvider
     */
    public function shouldCorrectlyDeserializeArray(array $input, Mapping $expectation)
    {
        $result = Operations::fromArray($input);
        Assert::assertEquals($expectation, $result);
    }
}
