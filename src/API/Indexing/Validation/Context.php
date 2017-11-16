<?php

namespace AmaTeam\ElasticSearch\API\Indexing\Validation;

class Context implements ContextInterface
{
    /**
     * @var string[]
     */
    private $path = [];
    /**
     * @var bool
     */
    private $preserveUnknownEntries = false;

    /**
     * @return string[]
     */
    public function getPath(): array
    {
        return $this->path;
    }

    /**
     * @param string[] $path
     * @return $this
     */
    public function setPath(array $path): Context
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return bool
     */
    public function shouldPreserveUnknownOptions(): bool
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
