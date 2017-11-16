<?php

namespace AmaTeam\ElasticSearch\Test\Support\Entity\Acceptance\Business;

use AmaTeam\ElasticSearch\API\Annotation\Document;
use AmaTeam\ElasticSearch\API\Annotation\Indexing\Replicas;
use AmaTeam\ElasticSearch\API\Annotation\Indexing\Shards;
use AmaTeam\ElasticSearch\API\Annotation\Mapping;
use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;
use DateTimeInterface;

/**
 * @Document(readIndices={"employee"}, writeIndices={"employee"})
 * @Parameter\Dynamic("false")
 * @Replicas(0)
 * @Shards(1)
 */
class Employee
{
    /**
     * @Mapping\Type("integer")
     * @Parameter\Index(false)
     *
     * @var integer
     */
    private $id;
    /**
     * @Mapping\Type("text")
     * @Parameter\IndexOptions("offsets")
     *
     * @var string
     */
    private $firstName;
    /**
     * @Mapping\Type("text")
     * @Parameter\IndexOptions("offsets")
     *
     * @var string
     */
    private $middleName;
    /**
     * @Mapping\Type("text")
     * @Parameter\IndexOptions("offsets")
     *
     * @var string
     */
    private $lastName;
    /**
     * @Mapping\Type("date")
     *
     * @var DateTimeInterface
     */
    private $joinedAt;
    /**
     * @Mapping\Type("object")
     * @Mapping\TargetEntity("Department")
     * @Mapping\Views("short")
     * @Mapping\IgnoredProperty("short")
     * @Parameter\Dynamic("true")
     *
     * @var Department
     */
    private $department;
    /**
     * @Mapping\Type("object")
     * @Mapping\TargetEntity("Rating")
     * @Mapping\IgnoredProperty("short")
     *
     * @var Rating
     */
    private $rating;
}
