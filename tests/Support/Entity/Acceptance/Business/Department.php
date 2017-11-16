<?php

namespace AmaTeam\ElasticSearch\Test\Support\Entity\Acceptance\Business;

use AmaTeam\ElasticSearch\API\Annotation\Document;
use AmaTeam\ElasticSearch\API\Annotation\Id;
use AmaTeam\ElasticSearch\API\Annotation\Indexing\RefreshInterval;
use AmaTeam\ElasticSearch\API\Annotation\Indexing\Replicas;
use AmaTeam\ElasticSearch\API\Annotation\Indexing\Shards;
use AmaTeam\ElasticSearch\API\Annotation\Mapping;
use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

/**
 * @Document(readIndices={"department"}, writeIndices={"department"}, type=null)
 * @Parameter\Dynamic("false")
 * @Replicas(0)
 * @Shards(10)
 * @RefreshInterval("1s")
 */
class Department
{
    /**
     * @Mapping\Type("integer")
     * @Parameter\Index(false)
     *
     * @var int
     */
    private $id;
    /**
     * @Mapping\Type("text")
     * @Parameter\IndexOptions("offsets")
     *
     * @var string
     */
    private $title;
    /**
     * @Mapping\Type("object")
     * @Mapping\IgnoredProperty("short")
     * @Mapping\TargetEntity("Rating")
     *
     * @var Rating
     */
    private $rating;
    /**
     * @Mapping\Type("object")
     * @Mapping\IgnoredProperty("short")
     * @Mapping\Views("short")
     * @Mapping\TargetEntity("Organization")
     *
     * @var Organization
     */
    private $organization;
}
