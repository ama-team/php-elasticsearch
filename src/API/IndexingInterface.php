<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API;

use AmaTeam\ElasticSearch\API\Indexing\AnalysisInterface;

interface IndexingInterface
{
    /**
     * @return string[]
     */
    public function getReadIndices(): array;

    /**
     * @return string[]
     */
    public function getWriteIndices(): array;
    public function getType(): ?string;
    public function getOptions(): array;
    public function getAnalysis(): AnalysisInterface;
}
