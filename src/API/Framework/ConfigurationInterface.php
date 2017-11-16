<?php

namespace AmaTeam\ElasticSearch\API\Framework;

use AmaTeam\ElasticSearch\API\ClientFactoryInterface;
use AmaTeam\ElasticSearch\API\Entity\Descriptor\LoaderInterface;

interface ConfigurationInterface
{
    /**
     * @return LoaderInterface[]
     */
    public function getLoaders(): array;

    /**
     * @return ClientFactoryInterface
     */
    public function getClientFactory(): ClientFactoryInterface;

    public function shouldValidate(): bool;

    public function shouldNormalize(): bool;

    public function shouldPreserveUnknownEntries(): bool;

    /**
     * @return string[]
     */
    public function getPreservedIndexingOptions(): array;

    /**
     * @return string[]
     */
    public function getPreservedMappingParameters(): array;
}
