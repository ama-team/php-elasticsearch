<?php

namespace AmaTeam\ElasticSearch\API\Entity\Mapping\Structure;

class View implements ViewInterface
{
    /**
     * @var string
     */
    private $type;
    /**
     * @var array
     */
    private $parameters = [];
    /**
     * @var string[]
     */
    private $ignoredProperties = [];
    /**
     * @var string[]
     */
    private $existingProperties = [];

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
    public function setType(string $type): View
    {
        $this->type = $type;
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
    public function setParameters(array $parameters): View
    {
        $this->parameters = $parameters;
        return $this;
    }

    public function hasParameter(string $parameter): bool
    {
        return isset($this->parameters[$parameter]);
    }

    public function getParameter(string $parameter)
    {
        return $this->parameters[$parameter] ?? null;
    }

    public function setParameter(string $parameter, $value): View
    {
        $this->parameters[$parameter] = $value;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getIgnoredProperties(): array
    {
        return array_values($this->ignoredProperties);
    }

    public function setIgnoredProperties(array $properties): View
    {
        $this->ignoredProperties = [];
        foreach ($properties as $property) {
            $this->addIgnoredProperty($property);
        }
        return $this;
    }

    /**
     * @param string $property
     * @return View
     */
    public function addIgnoredProperty(string $property): View
    {
        $this->ignoredProperties[$property] = $property;
        return $this;
    }

    public function forgetIgnoredProperty(string $name): View
    {
        unset($this->ignoredProperties[$name]);
        return $this;
    }

    /**
     * @return string[]
     */
    public function getExistingProperties(): array
    {
        return array_values($this->existingProperties);
    }

    /**
     * @param string[] $existingProperties
     * @return $this
     */
    public function setExistingProperties(array $existingProperties): View
    {
        $this->existingProperties = [];
        foreach ($existingProperties as $property) {
            $this->addExistingProperty($property);
        }
        return $this;
    }

    public function addExistingProperty(string $property): View
    {
        $this->existingProperties[$property] = $property;
        return $this;
    }

    public function forgetExistingProperty(string $property): View
    {
        unset($this->existingProperties[$property]);
        return $this;
    }
}
