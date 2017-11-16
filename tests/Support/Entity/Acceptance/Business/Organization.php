<?php

namespace AmaTeam\ElasticSearch\Test\Support\Entity\Acceptance\Business;

use AmaTeam\ElasticSearch\API\Annotation\Document;
use AmaTeam\ElasticSearch\API\Annotation\Indexing\Replicas;
use AmaTeam\ElasticSearch\API\Annotation\Mapping;
use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

/**
 * @Document(readIndices={"organization"}, writeIndices={"organization"})
 * @Parameter\Dynamic("false")
 * @Replicas(0)
 */
class Organization
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
     * @Mapping\Views("short")
     * @Mapping\TargetEntity("Department")
     * @Mapping\IgnoredProperty("short")
     *
     * @var Department[]
     */
    private $departments;
    /**
     * @Mapping\Type("object")
     * @Mapping\IgnoredProperty("short")
     * @Mapping\TargetEntity("Rating")
     *
     * @var Rating
     */
    private $rating;
}
