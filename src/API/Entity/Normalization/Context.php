<?php

namespace AmaTeam\ElasticSearch\API\Entity\Normalization;

class Context implements ContextInterface
{
    /**
     * @var string[]
     */
    private $preservedIndexingOptions = [];
    /**
     * @var string[]
     */
    private $preservedMappingParameters = [];
    /**
     * @var bool
     */
    private $preserveUnknownEntries = false;

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
}
