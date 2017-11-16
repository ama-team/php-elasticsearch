<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractBooleanParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\EnablePositionIncrementsParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class EnablePositionIncrements extends AbstractBooleanParameter
{
    public function getId(): string
    {
        return EnablePositionIncrementsParameter::FRIENDLY_ID;
    }
}
