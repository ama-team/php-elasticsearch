<?php

namespace AmaTeam\ElasticSearch\API;

use JMS\Serializer\Annotation as Serializer;

class Mapping implements MappingInterface
{
    /**
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $type;
    /**
     * @Serializer\Type("array")
     *
     * @var array
     */
    private $parameters = [];
    /**
     * @Serializer\Type("array<string, AmaTeam\ElasticSearch\API\Mapping>")
     *
     * @var MappingInterface[]
     */
    private $properties = [];

    /**
     * @param string $type
     */
    public function __construct(string $type = null)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): Mapping
    {
        $this->type = $type;
        return $this;
    }

    public function hasParameter(string $name): bool
    {
        return array_key_exists($name, $this->parameters);
    }

    public function getParameter(string $name)
    {
        return $this->parameters[$name] ?? null;
    }

    public function setParameter(string $parameter, $value): Mapping
    {
        $this->parameters[$parameter] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return $this
     */
    public function setParameters(array $parameters): Mapping
    {
        $this->parameters = $parameters;
        return $this;
    }

    public function hasProperty(string $name): bool
    {
        return isset($this->properties[$name]);
    }

    public function getProperty(string $name): ?MappingInterface
    {
        return $this->properties[$name] ?? null;
    }

    public function setProperty(string $name, MappingInterface $mapping): Mapping
    {
        $this->properties[$name] = $mapping;
        return $this;
    }

    public function removeProperty(string $name): Mapping
    {
        unset($this->properties[$name]);
        return $this;
    }

    /**
     * @return MappingInterface[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @param MappingInterface[] $properties
     * @return $this
     */
    public function setProperties(array $properties): Mapping
    {
        $this->properties = $properties;
        return $this;
    }
}
