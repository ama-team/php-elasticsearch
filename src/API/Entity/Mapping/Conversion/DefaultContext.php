<?php

namespace AmaTeam\ElasticSearch\API\Entity\Mapping\Conversion;

class DefaultContext implements ContextInterface
{
    /**
     * @var string[]
     */
    private $views = [];
    /**
     * @var bool
     */
    private $rootLevelMapping = false;

    /**
     * @return string[]
     */
    public function getViews(): array
    {
        return $this->views;
    }

    /**
     * @param string[] $views
     * @return $this
     */
    public function setViews(array $views): DefaultContext
    {
        $this->views = $views;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRootLevelMapping(): bool
    {
        return $this->rootLevelMapping;
    }

    /**
     * @param bool $rootLevelMapping
     * @return $this
     */
    public function setRootLevelMapping(bool $rootLevelMapping): DefaultContext
    {
        $this->rootLevelMapping = $rootLevelMapping;
        return $this;
    }

    public static function from(ContextInterface $context): DefaultContext
    {
        return (new DefaultContext())
            ->setViews($context->getViews())
            ->setRootLevelMapping($context->isRootLevelMapping());
    }
}
