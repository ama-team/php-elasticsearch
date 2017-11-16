<?php

namespace AmaTeam\ElasticSearch\API\Entity\Mapping\Property;

class Mapping implements MappingInterface
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $originalName;
    /**
     * @var ViewInterface
     */
    private $defaultView;
    /**
     * @var ViewInterface[]
     */
    private $views = [];

    public function __construct()
    {
        $this->defaultView = new View();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): Mapping
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    /**
     * @param string $originalName
     * @return $this
     */
    public function setOriginalName(string $originalName): Mapping
    {
        $this->originalName = $originalName;
        return $this;
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

    public function getView(string $name): ?ViewInterface
    {
        return $this->views[$name] ?? null;
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
     * @param ViewInterface[] $views
     * @return $this
     */
    public function setViews(array $views): Mapping
    {
        $this->views = $views;
        return $this;
    }

    public function setView(string $name, ViewInterface $view): Mapping
    {
        $this->views[$name] = $view;
        return $this;
    }
}
