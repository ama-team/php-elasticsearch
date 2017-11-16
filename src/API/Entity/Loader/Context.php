<?php

namespace AmaTeam\ElasticSearch\API\Entity\Loader;

class Context implements ContextInterface
{
    /**
     * @var bool
     */
    private $validate = true;
    /**
     * @var bool
     */
    private $normalize = true;
    /**
     * @var bool
     */
    private $preserveUnknownEntries = false;
    /**
     * @var string[]
     */
    private $preservedMappingParameters = [];
    /**
     * @var string[]
     */
    private $preservedIndexingOptions = [];

    /**
     * @return bool
     */
    public function shouldValidate(): bool
    {
        return $this->validate;
    }

    /**
     * @param bool $validate
     * @return $this
     */
    public function setValidate(bool $validate): Context
    {
        $this->validate = $validate;
        return $this;
    }

    /**
     * @return bool
     */
    public function shouldPreserveUnknownEntries(): bool
    {
        return $this->preserveUnknownEntries;
    }

    /**
     * @param bool $preserveUnknownEntries
     * @return $this
     */
    public function setPreserveUnknownEntries(bool $preserveUnknownEntries): Context
    {
        $this->preserveUnknownEntries = $preserveUnknownEntries;
        return $this;
    }

    /**
     * @return bool
     */
    public function shouldNormalize(): bool
    {
        return $this->normalize;
    }

    /**
     * @param bool $normalize
     * @return $this
     */
    public function setNormalize(bool $normalize): Context
    {
        $this->normalize = $normalize;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getPreservedMappingParameters(): array
    {
        return $this->preservedMappingParameters;
    }

    /**
     * @param string[] $preservedMappingParameters
     * @return $this
     */
    public function setPreservedMappingParameters(array $preservedMappingParameters): Context
    {
        $this->preservedMappingParameters = $preservedMappingParameters;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getPreservedIndexingOptions(): array
    {
        return $this->preservedIndexingOptions;
    }

    /**
     * @param string[] $preservedIndexingOptions
     * @return $this
     */
    public function setPreservedIndexingOptions(array $preservedIndexingOptions): Context
    {
        $this->preservedIndexingOptions = $preservedIndexingOptions;
        return $this;
    }
}
