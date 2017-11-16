<?php

namespace AmaTeam\ElasticSearch\Test\Support\Entity\Acceptance\Business;

use AmaTeam\ElasticSearch\API\Annotation\Embeddable;
use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Dynamic;
use AmaTeam\ElasticSearch\API\Annotation\Mapping\Type;

/**
 * @Embeddable()
 * @Dynamic("true")
 */
class Rating
{
    /**
     * @Type("float")
     *
     * @var float
     */
    private $overall;
    /**
     * @Type("float")
     *
     * @var float
     */
    private $month;
    /**
     * @Type("float")
     *
     * @var float
     */
    private $year;
}
