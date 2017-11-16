<?php

namespace AmaTeam\ElasticSearch\Test\Suite\Functional\Indexing;

use AmaTeam\ElasticSearch\API\Indexing;
use AmaTeam\ElasticSearch\API\Indexing\Validation\Context;
use AmaTeam\ElasticSearch\API\Indexing\ValidatorInterface;
use AmaTeam\ElasticSearch\Indexing\Operations;
use AmaTeam\ElasticSearch\Indexing\Option\NumberOfReplicasOption;
use AmaTeam\ElasticSearch\Indexing\Option\NumberOfShardsOption;
use AmaTeam\ElasticSearch\Indexing\Validation\Constraint\ValidOptionName;
use AmaTeam\ElasticSearch\Indexing\Validator;
use Codeception\Test\Unit;
use PHPUnit\Framework\Assert;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\ConstraintViolation;

class ValidatorTest extends Unit
{
    /**
     * @var Indexing
     */
    private $dummy;
    /**
     * @var ValidatorInterface
     */
    private $validator;

    protected function _before()
    {
        $this->dummy = (new Indexing())
            ->setWriteIndices([])
            ->setReadIndices([])
            ->setType('doc');
        $this->validator = new Validator();
    }

    /**
     * @test
     */
    public function shouldUseOptionConstraints()
    {
        $input = Operations::from($this->dummy)
            ->setOption(NumberOfReplicasOption::ID, 'twelve replicas, please');
        $violations = $this->validator->validate($input);
        Assert::assertEquals(1, $violations->count());
        /** @var ConstraintViolation $violation */
        $violation = $violations[0];
        Assert::assertInstanceOf(Type::class, $violation->getConstraint());
    }

    /**
     * @test
     */
    public function shouldStopUnknownOptions()
    {
        $input = Operations::from($this->dummy)
            ->setOption('index.wharrgarbl.option', 273);
        $violations = $this->validator->validate($input, (new Context())->setPreserveUnknownEntries(false));
        Assert::assertEquals(1, $violations->count());
        /** @var ConstraintViolation $violation */
        $violation = $violations[0];
        Assert::assertInstanceOf(ValidOptionName::class, $violation->getConstraint());
    }

    /**
     * @test
     */
    public function shouldIgnoreUnknownOptionsIfAsked()
    {
        $input = Operations::from($this->dummy)
            ->setOption('index.wharrgarbl.option', 273);
        $violations = $this->validator->validate($input, (new Context())->setPreserveUnknownEntries(true));
        Assert::assertEquals(0, $violations->count());
    }

    /**
     * @test
     */
    public function shouldStopFriendlyIds()
    {
        $input = Operations::from($this->dummy)
            ->setOption(NumberOfShardsOption::FRIENDLY_ID, 3);
        $violations = $this->validator->validate($input);
        Assert::assertEquals(1, $violations->count());
        /** @var ConstraintViolation $violation */
        $violation = $violations[0];
        Assert::assertInstanceOf(ValidOptionName::class, $violation->getConstraint());
    }
}
