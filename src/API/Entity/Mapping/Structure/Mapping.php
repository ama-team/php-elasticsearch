<?php

namespace AmaTeam\ElasticSearch\API\Entity\Mapping\Structure;

use AmaTeam\ElasticSearch\API\Entity\Mapping\Property\Mapping as PropertyMapping;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Property\MappingInterface as PropertyMappingInterface;

class Mapping implements MappingInterface
{
    /**
     * @var ViewInterface
     */
    private $defaultView;
    /**
     * @var ViewInterface[]
     */
    private $views = [];
    /**
     * @var PropertyMappingInterface[]
     */
    private $properties = [];
    /**
     * @var string[]
     */
    private $ignoredParentProperties = [];

    public function __construct()
    {
        $this->defaultView = new View();
    }

    /**
     * @return ViewInterface
     */
    public function getDefaultView(): ViewInterface
    {
        return $this->defaultView;
    }

    /**
     * @param ViewInterface $defaultView
     * @return $this
     */
    public function setDefaultView(ViewInterface $defaultView): Mapping
    {
        $this->defaultView = $defaultView;
        return $this;
    }

    /**
     * @return ViewInterface[]
     */
    public function getViews(): array
    {
        return $this->views;
    }

    /**
     * @param ViewInterface[] $views
     * @return $this
     */
    public function setViews(array $views): Mapping
    {
        $this->views = $views;
        return $this;
    }

    public function getView(string $name): ?ViewInterface
    {
        return $this->views[$name] ?? null;
    }

    public function setView(string $name, ViewInterface $view): Mapping
    {
        $this->views[$name] = $view;
        return $this;
    }

    public function requestView(string $name): ViewInterface
    {
        if (!isset($this->views[$name])) {
            $this->views[$name] = new View();
        }
        return $this->views[$name];
    }

    /**
     * @param string[] ...$names
     * @return ViewInterface[]
     */
    public function requestViews(string ...$names): array
    {
        return array_map([$this, 'requestView'], $names);
    }

    /**
     * @return PropertyMappingInterface[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @param PropertyMappingInterface[] $properties
     * @return $this
     */
    public function setProperties(array $properties): Mapping
    {
        $this->properties = $properties;
        return $this;
    }

    public function getProperty(string $property): ?PropertyMappingInterface
    {
        return $this->properties[$property] ?? null;
    }

    public function requestProperty(string $property): PropertyMappingInterface
    {
        if (!isset($this->properties[$property])) {
            $this->properties[$property] = new PropertyMapping();
        }
        return $this->properties[$property];
    }

    /**
     * @param string[] ...$names
     * @return PropertyMappingInterface[]
     */
    public function requestProperties(string ...$names): array
    {
        return array_map([$this, 'requestProperty'], $names);
    }

    public function setProperty(string $property, PropertyMappingInterface $mapping): Mapping
    {
        $this->properties[$property] = $mapping;
        return $this;
    }

    public function removeProperty(string $property): Mapping
    {
        unset($this->properties[$property]);
        return $this;
    }

    /**
     * @return string[]
     */
    public function getIgnoredParentProperties(): array
    {
        return $this->ignoredParentProperties;
    }

    /**
     * @param string[] $ignoredParentProperties
     * @return $this
     */
    public function setIgnoredParentProperties(array $ignoredParentProperties): Mapping
    {
        $this->ignoredParentProperties = $ignoredParentProperties;
        return $this;
    }
}
