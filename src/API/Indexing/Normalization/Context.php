<?php

namespace AmaTeam\ElasticSearch\API\Indexing\Normalization;

class Context implements ContextInterface
{
    /**
     * @var bool
     */
    private $preserveUnknownOptions = false;
    /**
     * @var string[]
     */
    private $preservedOptions = [];

    /**
     * @return bool
     */
    public function shouldPreserveUnknownOptions(): bool
    {
        return $this->preserveUnknownOptions;
    }

    /**
     * @param bool $preserveUnknownOptions
     * @return $this
     */
    public function setPreserveUnknownOptions(bool $preserveUnknownOptions): Context
    {
        $this->preserveUnknownOptions = $preserveUnknownOptions;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getPreservedOptions(): array
    {
        return $this->preservedOptions;
    }

    /**
     * @param string[] $preservedOptions
     * @return $this
     */
    public function setPreservedOptions(array $preservedOptions): Context
    {
        $this->preservedOptions = $preservedOptions;
        return $this;
    }
}
