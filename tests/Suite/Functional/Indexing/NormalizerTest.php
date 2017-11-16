<?php

namespace AmaTeam\ElasticSearch\Test\Suite\Functional\Indexing;

use AmaTeam\ElasticSearch\API\Indexing;
use AmaTeam\ElasticSearch\API\Indexing\Normalization\Context;
use AmaTeam\ElasticSearch\API\Indexing\OptionInterface;
use AmaTeam\ElasticSearch\Indexing\Normalizer;
use AmaTeam\ElasticSearch\Indexing\Operations;
use AmaTeam\ElasticSearch\Indexing\Option\Infrastructure\Registry;
use AmaTeam\ElasticSearch\Indexing\Option\NumberOfReplicasOption;
use Codeception\Test\Unit;
use PHPUnit\Framework\Assert;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class NormalizerTest extends Unit
{
    /**
     * @var Indexing
     */
    private $dummy;

    protected function _before()
    {
        $this->dummy = (new Indexing())
            ->setReadIndices([])
            ->setWriteIndices([])
            ->setType('doc');
    }

    /**
     * @test
     */
    public function shouldNormalizeKnownOptionName()
    {
        $id = 'alpha';
        $friendlyId = 'beta';
        /** @var Mock|OptionInterface $option */
        $option = $this->createMock(OptionInterface::class);
        $option
            ->expects($this->any())
            ->method('getId')
            ->willReturn($id);
        $option
            ->expects($this->any())
            ->method('getFriendlyId')
            ->willReturn($friendlyId);
        $registry = (new Registry())->register($option);
        $input = Operations::from($this->dummy)->setOption($friendlyId, 'value');
        $expectation = Operations::from($this->dummy)->setOption($id, 'value');
        $output = (new Normalizer($registry))->normalize($input);
        Assert::assertEquals($expectation, $output);
    }

    /**
     * @test
     */
    public function shouldStripUnknownOption()
    {
        $option = 'alpha';
        $context = (new Context())->setPreserveUnknownOptions(false);
        $input = Operations::from($this->dummy)->setOption($option, 'value');
        $output = (new Normalizer())->normalize($input, $context);
        Assert::assertEquals($this->dummy, $output);
    }

    /**
     * @test
     */
    public function shouldPreserveUnknownOptions()
    {
        $option = 'alpha';
        $context = (new Context())->setPreserveUnknownOptions(true);
        $input = Operations::from($this->dummy)->setOption($option, 'value');
        $output = (new Normalizer())->normalize($input, $context);
        Assert::assertEquals($input, $output);
    }

    /**
     * @test
     */
    public function shouldPreserveUnknownOption()
    {
        $option = 'alpha';
        $context = (new Context())
            ->setPreserveUnknownOptions(false)
            ->setPreservedOptions([$option]);
        $input = Operations::from($this->dummy)->setOption($option, 'value');
        $output = (new Normalizer())->normalize($input, $context);
        Assert::assertEquals($input, $output);
    }

    /**
     * @test
     */
    public function shouldDeduplicateIndices()
    {
        $index = 'curly';
        $indices = [$index, $index, $index];
        $input = Operations::from($this->dummy)
            ->setReadIndices($indices)
            ->setWriteIndices($indices);
        $expectation = Operations::from($this->dummy)
            ->setReadIndices([$index])
            ->setWriteIndices([$index]);
        $output = (new Normalizer())->normalize($input);
        Assert::assertEquals($expectation, $output);
    }

    /**
     * @test
     */
    public function shouldRemoveNullValues()
    {
        $input = Operations::from($this->dummy);
        $input->setOption(NumberOfReplicasOption::ID, null);
        $expectation = Operations::from($this->dummy);
        $output = (new Normalizer())->normalize($input);
        Assert::assertEquals($expectation, $output);
    }
}
