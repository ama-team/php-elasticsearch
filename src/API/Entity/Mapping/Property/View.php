<?php

namespace AmaTeam\ElasticSearch\API\Entity\Mapping\Property;

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
     * @var string|null
     */
    private $targetEntity;
    /**
     * @var string[]
     */
    private $childViews = [];
    /**
     * @var bool
     */
    private $appendChildViews = true;

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

    public function setParameter(string $parameter, $value): View
    {
        $this->parameters[$parameter] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getTargetEntity(): ?string
    {
        return $this->targetEntity;
    }

    /**
     * @param string $targetEntity
     * @return $this
     */
    public function setTargetEntity(string $targetEntity): View
    {
        $this->targetEntity = $targetEntity;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getChildViews(): array
    {
        return $this->childViews;
    }

    /**
     * @param string[] $childViews
     * @return $this
     */
    public function setChildViews(array $childViews): View
    {
        $this->childViews = $childViews;
        return $this;
    }

    /**
     * @return bool
     */
    public function shouldAppendChildViews(): bool
    {
        return $this->appendChildViews;
    }

    /**
     * @param bool $appendChildViews
     * @return $this
     */
    public function setAppendChildViews(bool $appendChildViews): View
    {
        $this->appendChildViews = $appendChildViews;
        return $this;
    }
}
