<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Test\Suite\Functional\Mapping;

use AmaTeam\ElasticSearch\API\Mapping;
use AmaTeam\ElasticSearch\Mapping\Type\BooleanType;
use AmaTeam\ElasticSearch\Mapping\Type\IntegerType;
use AmaTeam\ElasticSearch\Mapping\Type\NestedType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DocValuesParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DynamicParameter;
use AmaTeam\ElasticSearch\Mapping\Type\RootType;
use AmaTeam\ElasticSearch\Mapping\Validation\Constraint\ApplicableParameter;
use AmaTeam\ElasticSearch\Mapping\Validation\Constraint\ValidParameterName;
use AmaTeam\ElasticSearch\Mapping\Validation\Constraint\ValidTypeName;
use AmaTeam\ElasticSearch\Mapping\Validator;
use Codeception\Test\Unit;
use PHPUnit\Framework\Assert;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\ConstraintViolation;

class ValidatorTest extends Unit
{
    /**
     * @test
     */
    public function shouldDetectUnknownType()
    {
        $mapping = new Mapping('unknown');
        $result = (new Validator())->validate($mapping);
        Assert::assertEquals(1, $result->count());
        /** @var ConstraintViolation $violation */
        $violation = $result[0];
        Assert::assertInstanceOf(ValidTypeName::class, $violation->getConstraint());
    }

    /**
     * @test
     */
    public function shouldDetectInvalidTypeName()
    {
        $mapping = new Mapping('geoPoint');
        $result = (new Validator())->validate($mapping);
        Assert::assertEquals(1, $result->count());
        /** @var ConstraintViolation $violation */
        $violation = $result[0];
        Assert::assertInstanceOf(ValidTypeName::class, $violation->getConstraint());
    }

    /**
     * @test
     */
    public function shouldDetectUnknownParameter()
    {
        $mapping = (new Mapping(RootType::ID))->setParameter('unknown', true);
        $result = (new Validator())->validate($mapping);
        Assert::assertEquals(1, $result->count());
        /** @var ConstraintViolation $violation */
        $violation = $result[0];
        Assert::assertInstanceOf(ValidParameterName::class, $violation->getConstraint());
    }

    /**
     * @test
     */
    public function shouldDetectInvalidParameterNaming()
    {
        $mapping = (new Mapping(BooleanType::ID))->setParameter('docValues', true);
        $result = (new Validator())->validate($mapping);
        Assert::assertEquals(1, $result->count());
        /** @var ConstraintViolation $violation */
        $violation = $result[0];
        Assert::assertInstanceOf(ValidParameterName::class, $violation->getConstraint());
    }

    /**
     * @test
     */
    public function shouldDetectInvalidParameterValue()
    {
        $mapping = (new Mapping(BooleanType::ID))->setParameter(DocValuesParameter::ID, 'twenty');
        $result = (new Validator())->validate($mapping);
        Assert::assertEquals(1, $result->count());
        /** @var ConstraintViolation $violation */
        $violation = $result[0];
        Assert::assertInstanceOf(Type::class, $violation->getConstraint());
    }

    /**
     * @test
     */
    public function shouldDetectMisplacedParameter()
    {
        $mapping = (new Mapping(BooleanType::ID))->setParameter(DynamicParameter::ID, false);
        $result = (new Validator())->validate($mapping);
        Assert::assertEquals(1, $result->count());
        /** @var ConstraintViolation $violation */
        $violation = $result[0];
        Assert::assertInstanceOf(ApplicableParameter::class, $violation->getConstraint());
    }

    /**
     * @test
     */
    public function shouldDetectIllegalNull()
    {
        $mapping = (new Mapping(BooleanType::ID))->setParameter(DocValuesParameter::ID, null);
        $result = (new Validator())->validate($mapping);
        Assert::assertEquals(1, $result->count());
        /** @var ConstraintViolation $violation */
        $violation = $result[0];
        Assert::assertInstanceOf(NotNull::class, $violation->getConstraint());
    }

    /**
     * @test
     */
    public function shouldRecursivelyAnalyzeProperties()
    {
        $mapping = (new Mapping(NestedType::ID))
            ->setProperties([
                'id' => (new Mapping(IntegerType::ID))->setParameter('unknown', false)
            ]);
        $result = (new Validator())->validate($mapping);
        Assert::assertEquals(1, $result->count());
        /** @var ConstraintViolation $violation */
        $violation = $result[0];
        Assert::assertInstanceOf(ValidParameterName::class, $violation->getConstraint());
        Assert::assertEquals('properties.id.unknown', $violation->getPropertyPath());
    }
}
