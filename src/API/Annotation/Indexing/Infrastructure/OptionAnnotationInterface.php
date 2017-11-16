<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Indexing\Infrastructure;

use AmaTeam\ElasticSearch\API\Indexing\OptionInterface;

interface OptionAnnotationInterface
{
    public function getOption(): OptionInterface;
    public function getValue();
}
