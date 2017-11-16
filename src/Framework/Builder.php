<?php

namespace AmaTeam\ElasticSearch\Framework;

use AmaTeam\ElasticSearch\API\ClientFactoryInterface;
use AmaTeam\ElasticSearch\API\DefaultClientFactory;
use AmaTeam\ElasticSearch\API\Entity\Descriptor\LoaderInterface;
use AmaTeam\ElasticSearch\API\Entity\Loader\Context;
use AmaTeam\ElasticSearch\API\Framework\BuilderInterface;
use AmaTeam\ElasticSearch\API\Framework\ConfigurationInterface;
use AmaTeam\ElasticSearch\API\FrameworkInterface;
use AmaTeam\ElasticSearch\Entity\Annotation\Loader;
use AmaTeam\ElasticSearch\Entity\Descriptor\Manager;
use AmaTeam\ElasticSearch\Entity\Loader as EntityLoader;
use AmaTeam\ElasticSearch\Entity\Registry;
use AmaTeam\ElasticSearch\Framework;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Builder implements BuilderInterface, ConfigurationInterface
{
    /**
     * @var LoaderInterface[]
     */
    private $loaders = [];
    /**
     * @var ClientFactoryInterface
     */
    private $clientFactory;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var bool
     */
    private $preserveUnknownEntries = false;
    /**
     * @var string[]
     */
    private $preservedIndexingOptions = [];
    /**
     * @var string[]
     */
    private $preservedMappingParameters = [];
    /**
     * @var bool
     */
    private $normalize = true;
    /**
     * @var bool
     */
    private $validate = true;

    public function __construct()
    {
        $this->loaders = [new Loader()];
        $this->logger = new NullLogger();
        $this->clientFactory = (new DefaultClientFactory())->setLogger($this->logger);
    }

    /**
     * @return LoaderInterface[]
     */
    public function getLoaders(): array
    {
        return $this->loaders;
    }

    public function registerLoader(LoaderInterface $loader): BuilderInterface
    {
        if (!in_array($loader, $this->loaders)) {
            $this->loaders[] = $loader;
        }
        return $this;
    }

    public function deregisterLoader(LoaderInterface $loader)
    {
        $this->loaders = array_filter($this->loaders, function (LoaderInterface $item) use ($loader) {
            return $loader !== $item;
        });
        return $this;
    }

    public function deregisterLoaders(): BuilderInterface
    {
        $this->loaders = [];
        return $this;
    }

    /**
     * @return ClientFactoryInterface
     */
    public function getClientFactory(): ClientFactoryInterface
    {
        return $this->clientFactory;
    }

    /**
     * @param ClientFactoryInterface $clientFactory
     * @return BuilderInterface
     */
    public function setClientFactory(ClientFactoryInterface $clientFactory): BuilderInterface
    {
        $this->clientFactory = $clientFactory;
        return $this;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface $logger
     * @return BuilderInterface
     */
    public function setLogger(LoggerInterface $logger): BuilderInterface
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @return bool
     */
    public function shouldPreserveUnknownEntries(): bool
    {
        return $this->preserveUnknownEntries;
    }

    /**
     * @param bool $preserveUnknownEntries
     * @return BuilderInterface
     */
    public function setPreserveUnknownEntries(bool $preserveUnknownEntries): BuilderInterface
    {
        $this->preserveUnknownEntries = $preserveUnknownEntries;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getPreservedIndexingOptions(): array
    {
        return $this->preservedIndexingOptions;
    }

    /**
     * @param string[] $options
     * @return BuilderInterface
     */
    public function setPreservedIndexingOptions(string ...$options): BuilderInterface
    {
        $this->preservedIndexingOptions = $options;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getPreservedMappingParameters(): array
    {
        return $this->preservedMappingParameters;
    }

    /**
     * @param string[] $parameters
     * @return BuilderInterface
     */
    public function setPreservedMappingParameters(string ...$parameters): BuilderInterface
    {
        $this->preservedMappingParameters = $parameters;
        return $this;
    }

    /**
     * @return bool
     */
    public function shouldNormalize(): bool
    {
        return $this->normalize;
    }

    /**
     * @param bool $normalize
     * @return BuilderInterface
     */
    public function setNormalize(bool $normalize): BuilderInterface
    {
        $this->normalize = $normalize;
        return $this;
    }

    /**
     * @return bool
     */
    public function shouldValidate(): bool
    {
        return $this->validate;
    }

    /**
     * @param bool $validate
     * @return BuilderInterface
     */
    public function setValidate(bool $validate): BuilderInterface
    {
        $this->validate = $validate;
        return $this;
    }

    public function build(): FrameworkInterface
    {
        $manager = new Manager();
        foreach ($this->loaders as $loader) {
            $manager->registerLoader($loader);
        }
        $loader = new EntityLoader($manager);
        $context = (new Context())
            ->setPreserveUnknownEntries($this->shouldPreserveUnknownEntries())
            ->setPreservedMappingParameters($this->getPreservedMappingParameters())
            ->setPreservedIndexingOptions($this->getPreservedIndexingOptions())
            ->setNormalize($this->shouldNormalize())
            ->setValidate($this->shouldValidate());
        $registry = new Registry($loader, $context);
        return new Framework($registry, $this);
    }
}
