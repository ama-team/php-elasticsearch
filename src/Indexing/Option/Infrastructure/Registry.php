<?php

namespace AmaTeam\ElasticSearch\Indexing\Option\Infrastructure;

use AmaTeam\ElasticSearch\API\Indexing\OptionInterface;
use AmaTeam\ElasticSearch\Indexing\Option\NumberOfReplicasOption;
use AmaTeam\ElasticSearch\Indexing\Option\NumberOfShardsOption;
use AmaTeam\ElasticSearch\Indexing\Option\RefreshIntervalOption;

class Registry
{
    /**
     * @var OptionInterface[]
     */
    protected $idIndex = [];
    /**
     * @var OptionInterface[]
     */
    protected $friendlyIdIndex = [];

    public function find(string $id): ?OptionInterface
    {
        if (isset($this->idIndex[$id])) {
            return $this->idIndex[$id];
        }
        if (isset($this->friendlyIdIndex[$id])) {
            return $this->friendlyIdIndex[$id];
        }
        return null;
    }

    /**
     * @param OptionInterface $option
     * @return $this
     */
    public function register(OptionInterface $option): Registry
    {
        $this->idIndex[$option->getId()] = $option;
        $this->friendlyIdIndex[$option->getFriendlyId()] = $option;
        return $this;
    }

    public function withDefaults(): Registry
    {
        $options = [
            NumberOfReplicasOption::getInstance(),
            NumberOfShardsOption::getInstance(),
            RefreshIntervalOption::getInstance()
        ];
        foreach ($options as $option) {
            $this->register($option);
        }
        return $this;
    }

    /**
     * @var Registry
     */
    private static $instance;

    public static function getInstance(): Registry
    {
        if (!isset(self::$instance)) {
            self::$instance = (new static())->withDefaults();
        }
        return self::$instance;
    }
}
