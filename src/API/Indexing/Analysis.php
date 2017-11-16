<?php

namespace AmaTeam\ElasticSearch\API\Indexing;

use AmaTeam\ElasticSearch\API\Indexing\Analysis\AnalyzerInterface;
use AmaTeam\ElasticSearch\API\Indexing\Analysis\CharacterFilterInterface;
use AmaTeam\ElasticSearch\API\Indexing\Analysis\TokenFilterInterface;
use AmaTeam\ElasticSearch\API\Indexing\Analysis\TokenizerInterface;

class Analysis implements AnalysisInterface
{
    /**
     * @var AnalyzerInterface[]
     */
    private $analyzers = [];
    /**
     * @var CharacterFilterInterface[]
     */
    private $characterFilters = [];
    /**
     * @var TokenizerInterface[]
     */
    private $tokenizers = [];
    /**
     * @var TokenFilterInterface[]
     */
    private $tokenFilters = [];

    /**
     * @return AnalyzerInterface[]
     */
    public function getAnalyzers(): array
    {
        return $this->analyzers;
    }

    public function getAnalyzer(string $name): ?AnalyzerInterface
    {
        return $this->analyzers[$name] ?? null;
    }

    /**
     * @param AnalyzerInterface[] $analyzers
     * @return $this
     */
    public function setAnalyzers(array $analyzers): Analysis
    {
        $this->analyzers = $analyzers;
        return $this;
    }

    public function setAnalyzer(string $name, AnalyzerInterface $analyzer): Analysis
    {
        $this->analyzers[$name] = $analyzer;
        return $this;
    }

    /**
     * @return CharacterFilterInterface[]
     */
    public function getCharacterFilters(): array
    {
        return $this->characterFilters;
    }

    public function getCharacterFilter(string $name): ?CharacterFilterInterface
    {
        return $this->characterFilters[$name] ?? null;
    }

    /**
     * @param CharacterFilterInterface[] $characterFilters
     * @return $this
     */
    public function setCharacterFilters(array $characterFilters): Analysis
    {
        $this->characterFilters = $characterFilters;
        return $this;
    }

    public function setCharacterFilter(string $name, CharacterFilterInterface $characterFilter): Analysis
    {
        $this->characterFilters[$name] = $characterFilter;
        return $this;
    }

    /**
     * @return TokenizerInterface[]
     */
    public function getTokenizers(): array
    {
        return $this->tokenizers;
    }

    public function getTokenizer(string $name): ?TokenizerInterface
    {
        return $this->tokenizers[$name] ?? null;
    }

    /**
     * @param TokenizerInterface[] $tokenizers
     * @return $this
     */
    public function setTokenizers(array $tokenizers): Analysis
    {
        $this->tokenizers = $tokenizers;
        return $this;
    }

    public function setTokenizer(string $name, TokenizerInterface $tokenizer): Analysis
    {
        $this->tokenizers[$name] = $tokenizer;
        return $this;
    }

    /**
     * @return TokenFilterInterface[]
     */
    public function getTokenFilters(): array
    {
        return $this->tokenFilters;
    }

    public function getTokenFilter(string $name): ?TokenFilterInterface
    {
        return $this->tokenFilters[$name] ?? null;
    }

    /**
     * @param TokenFilterInterface[] $tokenFilters
     * @return $this
     */
    public function setTokenFilters(array $tokenFilters): Analysis
    {
        $this->tokenFilters = $tokenFilters;
        return $this;
    }

    public function setTokenFilter(string $name, TokenFilterInterface $tokenFilter): Analysis
    {
        $this->tokenFilters[$name] = $tokenFilter;
        return $this;
    }
}
