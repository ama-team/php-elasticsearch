<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API;

use AmaTeam\ElasticSearch\API\Indexing\Analysis;
use AmaTeam\ElasticSearch\API\Indexing\AnalysisInterface;

class Indexing implements IndexingInterface
{
    /**
     * @var string[]
     */
    private $readIndices = [];
    /**
     * @var string[]
     */
    private $writeIndices = [];
    /**
     * @var string
     */
    private $type;
    /**
     * @var array
     */
    private $options = [];
    /**
     * @var AnalysisInterface
     */
    private $analysis;

    public function __construct()
    {
        $this->analysis = new Analysis();
    }

    /**
     * @return string[]
     */
    public function getReadIndices(): array
    {
        return $this->readIndices;
    }

    /**
     * @param string[] $readIndices
     * @return $this
     */
    public function setReadIndices(array $readIndices)
    {
        $this->readIndices = $readIndices;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getWriteIndices(): array
    {
        return $this->writeIndices;
    }

    /**
     * @param string[] $writeIndices
     * @return $this
     */
    public function setWriteIndices(array $writeIndices)
    {
        $this->writeIndices = $writeIndices;
        return $this;
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
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    public function setOption(string $name, $value): Indexing
    {
        $this->options[$name] = $value;
        return $this;
    }

    /**
     * @return AnalysisInterface
     */
    public function getAnalysis(): AnalysisInterface
    {
        return $this->analysis;
    }

    /**
     * @param AnalysisInterface $analysis
     * @return $this
     */
    public function setAnalysis(AnalysisInterface $analysis): Indexing
    {
        $this->analysis = $analysis;
        return $this;
    }
}
