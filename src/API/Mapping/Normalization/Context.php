<?php

namespace AmaTeam\ElasticSearch\API\Mapping\Normalization;

class Context implements ContextInterface
{
    /**
     * @var bool
     */
    private $preserveUnknownParameters = false;
    /**
     * @var string[]
     */
    private $preservedParameters = [];
    /**
     * @var bool
     */
    private $rootMapping = false;

    public function shouldPreserveUnknownParameters(): bool
    {
        return $this->preserveUnknownParameters;
    }

    /**
     * @param bool $preserveUnknownParameters
     * @return Context
     */
    public function setPreserveUnknownParameters(bool $preserveUnknownParameters): Context
    {
        $this->preserveUnknownParameters = $preserveUnknownParameters;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getPreservedParameters(): array
    {
        return $this->preservedParameters;
    }

    /**
     * @param string[] $preservedParameters
     * @return Context
     */
    public function setPreservedParameters(array $preservedParameters): Context
    {
        $this->preservedParameters = $preservedParameters;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRootMapping(): bool
    {
        return $this->rootMapping;
    }

    /**
     * @param bool $rootMapping
     * @return $this
     */
    public function setRootMapping(bool $rootMapping): Context
    {
        $this->rootMapping = $rootMapping;
        return $this;
    }

    public static function from(ContextInterface $context): Context
    {
        return (new Context())
            ->setPreservedParameters($context->getPreservedParameters())
            ->setPreserveUnknownParameters($context->shouldPreserveUnknownParameters())
            ->setRootMapping($context->isRootMapping());
    }
}
