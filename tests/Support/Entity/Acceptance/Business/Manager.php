<?php

namespace AmaTeam\ElasticSearch\Test\Support\Entity\Acceptance\Business;

use AmaTeam\ElasticSearch\API\Annotation\Document;
use AmaTeam\ElasticSearch\API\Annotation\Indexing\Replicas;
use AmaTeam\ElasticSearch\API\Annotation\Mapping;
use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

/**
 * @Document(readIndices={"manager"}, writeIndices={"manager"})
 * @Mapping\IgnoredParentProperties("joinedAt")
 * @Parameter\Dynamic("false")
 * @Replicas(0)
 */
class Manager extends Employee
{
    /**
     * @Mapping\Type("keyword")
     * @Parameter\DocValues(true)
     *
     * @var string
     */
    private $capabilities;
}
