<?php

namespace AmaTeam\ElasticSearch\API\Framework;

use AmaTeam\ElasticSearch\API\ClientFactoryInterface;
use AmaTeam\ElasticSearch\API\Entity\Descriptor\LoaderInterface;
use AmaTeam\ElasticSearch\API\FrameworkInterface;
use Psr\Log\LoggerInterface;

interface BuilderInterface
{
    public function registerLoader(LoaderInterface $loader): BuilderInterface;
    public function deregisterLoader(LoaderInterface $loader);
    public function deregisterLoaders(): BuilderInterface;
    public function setClientFactory(ClientFactoryInterface $factory): BuilderInterface;
    public function setLogger(LoggerInterface $logger): BuilderInterface;
    public function setPreserveUnknownEntries(bool $value): BuilderInterface;
    public function setPreservedIndexingOptions(string ...$options): BuilderInterface;
    public function setPreservedMappingParameters(string ...$parameters): BuilderInterface;

    /**
     * Allows to turn off entity metadata validation
     *
     * @param bool $value
     * @return BuilderInterface
     */
    public function setValidate(bool $value): BuilderInterface;

    /**
     * Allows to turn off entity metadata normalization
     *
     * @param bool $value
     * @return BuilderInterface
     */
    public function setNormalize(bool $value): BuilderInterface;
    public function build(): FrameworkInterface;
}
