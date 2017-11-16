<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Mapping\Type\Infrastructure;

use AmaTeam\ElasticSearch\API\Mapping\TypeInterface;
use AmaTeam\ElasticSearch\Mapping\Type\BinaryType;
use AmaTeam\ElasticSearch\Mapping\Type\BooleanType;
use AmaTeam\ElasticSearch\Mapping\Type\ByteType;
use AmaTeam\ElasticSearch\Mapping\Type\DateRangeType;
use AmaTeam\ElasticSearch\Mapping\Type\DateType;
use AmaTeam\ElasticSearch\Mapping\Type\DoubleRangeType;
use AmaTeam\ElasticSearch\Mapping\Type\DoubleType;
use AmaTeam\ElasticSearch\Mapping\Type\FloatRangeType;
use AmaTeam\ElasticSearch\Mapping\Type\FloatType;
use AmaTeam\ElasticSearch\Mapping\Type\GeoPointType;
use AmaTeam\ElasticSearch\Mapping\Type\GeoShapeType;
use AmaTeam\ElasticSearch\Mapping\Type\HalfFloatType;
use AmaTeam\ElasticSearch\Mapping\Type\IntegerRangeType;
use AmaTeam\ElasticSearch\Mapping\Type\IntegerType;
use AmaTeam\ElasticSearch\Mapping\Type\IpRangeType;
use AmaTeam\ElasticSearch\Mapping\Type\IpType;
use AmaTeam\ElasticSearch\Mapping\Type\JoinType;
use AmaTeam\ElasticSearch\Mapping\Type\KeywordType;
use AmaTeam\ElasticSearch\Mapping\Type\LongRangeType;
use AmaTeam\ElasticSearch\Mapping\Type\LongType;
use AmaTeam\ElasticSearch\Mapping\Type\NestedType;
use AmaTeam\ElasticSearch\Mapping\Type\ObjectType;
use AmaTeam\ElasticSearch\Mapping\Type\PercolatorType;
use AmaTeam\ElasticSearch\Mapping\Type\RootType;
use AmaTeam\ElasticSearch\Mapping\Type\ScaledFloatType;
use AmaTeam\ElasticSearch\Mapping\Type\ShortType;
use AmaTeam\ElasticSearch\Mapping\Type\TextType;
use AmaTeam\ElasticSearch\Mapping\Type\TokenCountType;
use BadMethodCallException;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Registry
{
    /**
     * @var TypeInterface[]
     */
    private $idIndex = [];
    /**
     * @var TypeInterface[]
     */
    private $friendlyIdIndex = [];

    /**
     * @param string $id
     * @return TypeInterface|null
     */
    public function find(string $id): ?TypeInterface
    {
        if (isset($this->friendlyIdIndex[$id])) {
            return $this->friendlyIdIndex[$id];
        }
        if (isset($this->idIndex[$id])) {
            return $this->idIndex[$id];
        }
        return null;
    }

    public function get(string $id): TypeInterface
    {
        $type = $this->find($id);
        if ($type) {
            return $type;
        }
        throw new BadMethodCallException("Unknown mapping type `$id`");
    }

    public function register(TypeInterface $type): Registry
    {
        $this->idIndex[$type->getId()] = $type;
        $this->friendlyIdIndex[$type->getFriendlyId()] = $type;
        return $this;
    }

    /**
     * @return TypeInterface[]
     */
    public function getAll(): array
    {
        return array_values($this->idIndex);
    }

    public function withDefaultTypes(): Registry
    {
        // TODO: use code generation
        $types = [
            BinaryType::getInstance(),
            BooleanType::getInstance(),
            ByteType::getInstance(),
            DateRangeType::getInstance(),
            DateType::getInstance(),
            DoubleRangeType::getInstance(),
            DoubleType::getInstance(),
            FloatRangeType::getInstance(),
            FloatType::getInstance(),
            GeoPointType::getInstance(),
            GeoShapeType::getInstance(),
            HalfFloatType::getInstance(),
            IntegerRangeType::getInstance(),
            IntegerType::getInstance(),
            IpRangeType::getInstance(),
            IpType::getInstance(),
            JoinType::getInstance(),
            KeywordType::getInstance(),
            LongRangeType::getInstance(),
            LongType::getInstance(),
            NestedType::getInstance(),
            ObjectType::getInstance(),
            PercolatorType::getInstance(),
            RootType::getInstance(),
            ScaledFloatType::getInstance(),
            ShortType::getInstance(),
            TextType::getInstance(),
            TokenCountType::getInstance(),
        ];
        foreach ($types as $type) {
            $this->register($type);
        }
        return $this;
    }

    private static $instance;

    public static function getInstance(): Registry
    {
        if (!static::$instance) {
            static::$instance = (new static())
                ->withDefaultTypes();
        }
        return static::$instance;
    }
}
