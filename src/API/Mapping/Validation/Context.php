<?php

namespace AmaTeam\ElasticSearch\API\Mapping\Validation;

class Context implements ContextInterface
{
    /**
     * @var string[]
     */
    private $path = [];
    /**
     * @var bool
     */
    private $preserveUnknownParameters = false;

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

    public function withAppendedPath(string ...$segments): Context
    {
        return static::from($this)->setPath(array_merge($this->path, $segments));
    }

    /**
     * @return bool
     */
    public function shouldPreserveUnknownParameters(): bool
    {
        return $this->preserveUnknownParameters;
    }

    /**
     * @param bool $preserveUnknownParameters
     * @return $this
     */
    public function setPreserveUnknownParameters(bool $preserveUnknownParameters): Context
    {
        $this->preserveUnknownParameters = $preserveUnknownParameters;
        return $this;
    }
    
    public static function from(ContextInterface $context): Context
    {
        return (new Context())
            ->setPath($context->getPath())
            ->setPreserveUnknownParameters($context->shouldPreserveUnknownParameters());
    }
}
