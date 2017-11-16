<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Test\Suite\Functional\Mapping;

use AmaTeam\ElasticSearch\API\Mapping\Normalization\Context;
use AmaTeam\ElasticSearch\API\Mapping;
use AmaTeam\ElasticSearch\Mapping\Normalizer;
use AmaTeam\ElasticSearch\Mapping\Type\BooleanType;
use AmaTeam\ElasticSearch\Mapping\Type\DateType;
use AmaTeam\ElasticSearch\Mapping\Type\IntegerType;
use AmaTeam\ElasticSearch\Mapping\Type\KeywordType;
use AmaTeam\ElasticSearch\Mapping\Type\ObjectType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DocValuesParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DynamicParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IgnoreMalformedParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NormalizerParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\NullValueParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\SourceParameter;
use AmaTeam\ElasticSearch\Mapping\Type\RootType;
use Codeception\Test\Unit;
use PHPUnit\Framework\Assert;

class NormalizerTest extends Unit
{
    public function dataProvider()
    {
        $variants = [];
        $variants[] = [
            (new Mapping())
                ->setType(RootType::ID)
                ->setParameter('dynamic', false)
                ->setParameter('_source', false)
                ->setProperties([
                    'id' => (new Mapping())
                        ->setType(IntegerType::ID)
                        ->setParameter('unknown', 'twenty')
                        ->setParameter('reallyUnknown', 'forty')
                        ->setParameter('null', null)
                ]),
            (new Context())
                ->setPreserveUnknownParameters(false)
                ->setPreservedParameters(['unknown']),
            (new Mapping())
                ->setType(RootType::ID)
                ->setParameter('dynamic', false)
                ->setParameter('_source', false)
                ->setProperties([
                    'id' => (new Mapping())
                        ->setType(IntegerType::ID)
                        ->setParameter('unknown', 'twenty')
                ]),
        ];
        $variants[] = [
            (new Mapping())
                ->setType(RootType::ID)
                ->setProperties([
                    'createdAt' => (new Mapping())
                        ->setType(DateType::ID)
                        ->setParameter(IgnoreMalformedParameter::ID, false),
                    'aspects' => (new Mapping())
                        ->setType(ObjectType::FRIENDLY_ID)
                        ->setParameter(DynamicParameter::FRIENDLY_ID, false)
                        ->setProperties([
                            'handsome' => (new Mapping())
                                ->setType(BooleanType::FRIENDLY_ID)
                                ->setParameter(DocValuesParameter::ID, true),
                            'brutal' => (new Mapping())
                                ->setType(BooleanType::ID)
                                ->setParameter(DocValuesParameter::ID, true)
                                ->setParameter(NullValueParameter::ID, true)
                        ])
                ]),
            (new Context())
                ->setPreserveUnknownParameters(false),
            (new Mapping())
                ->setType(RootType::ID)
                ->setProperties([
                    'createdAt' => (new Mapping())
                        ->setType(DateType::ID)
                        ->setParameter(IgnoreMalformedParameter::ID, false),
                    'aspects' => (new Mapping())
                        ->setType(ObjectType::ID)
                        ->setParameter(DynamicParameter::ID, false)
                        ->setProperties([
                            'handsome' => (new Mapping())
                                ->setType(BooleanType::ID)
                                ->setParameter(DocValuesParameter::ID, true),
                            'brutal' => (new Mapping())
                                ->setType(BooleanType::ID)
                                ->setParameter(DocValuesParameter::ID, true)
                                ->setParameter(NullValueParameter::ID, true)
                        ])
                ]),
        ];
        return $variants;
    }

    /**
     * @param Mapping $mapping
     * @param Context $context
     * @param Mapping $expectation
     *
     * @test
     * @dataProvider dataProvider
     */
    public function shouldFulfillExpectations(Mapping $mapping, Context $context, Mapping $expectation)
    {
        $result = (new Normalizer())->normalize($mapping, $context);
        Assert::assertEquals($expectation, $result);
    }

    /**
     * @test
     */
    public function shouldRemoveUnknownParameters()
    {
        $mapping = (new Mapping())
            ->setType(RootType::ID)
            ->setParameter('unknown', 'twenty');
        $expectation = (new Mapping())
            ->setType(RootType::ID);
        $normalizer = new Normalizer();
        $context = (new Context())->setPreserveUnknownParameters(false);
        $result = $normalizer->normalize($mapping, $context);
        Assert::assertEquals($expectation, $result);
    }

    /**
     * @test
     */
    public function shouldNotRemoveUnknownParameters()
    {
        $mapping = (new Mapping())
            ->setType(RootType::ID)
            ->setParameter('unknown', 'value');
        $context = (new Context())->setPreserveUnknownParameters(true);
        $result = (new Normalizer())->normalize($mapping, $context);
        Assert::assertEquals($mapping, $result);
    }

    /**
     * @test
     */
    public function shouldRemoveCommonNullValuedParameters()
    {
        $mapping = (new Mapping())
            ->setType(RootType::ID)
            ->setParameter(SourceParameter::ID, null);
        $expectation = (new Mapping())
            ->setType(RootType::ID);
        $context = (new Context())->setPreserveUnknownParameters(true);
        $result = (new Normalizer())->normalize($mapping, $context);
        Assert::assertEquals($expectation, $result);
    }

    /**
     * @test
     */
    public function shouldNotRemoveNullAllowedNullValuedParameters()
    {
        $mapping = (new Mapping())
            ->setType(KeywordType::ID)
            ->setParameter(NormalizerParameter::ID, null);
        $context = (new Context())->setPreserveUnknownParameters(true);
        $result = (new Normalizer())->normalize($mapping, $context);
        Assert::assertEquals($mapping, $result);
    }

    /**
     * @test
     */
    public function shouldNormalizeParameterNames()
    {
        $mapping = (new Mapping())
            ->setType(DateType::ID)
            ->setParameter(IgnoreMalformedParameter::FRIENDLY_ID, true);
        $expectation = (new Mapping())
            ->setType(DateType::ID)
            ->setParameter(IgnoreMalformedParameter::ID, true);
        $result = (new Normalizer())->normalize($mapping);
        Assert::assertEquals($expectation, $result);
    }
}
