<?php

namespace AmaTeam\ElasticSearch\API\Entity\Loader;

use AmaTeam\ElasticSearch\API\Entity\Normalization\ContextInterface as NormalizationContextInterface;
use AmaTeam\ElasticSearch\API\Entity\Validation\ContextInterface as ValidationContextInterface;

interface ContextInterface extends NormalizationContextInterface, ValidationContextInterface
{
    public function shouldValidate(): bool;
    public function shouldNormalize(): bool;
}
