<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter\Infrastructure\AbstractBooleanParameterAnnotation;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\EagerGlobalOrdinalsParameter;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 */
class EagerGlobalOrdinals extends AbstractBooleanParameterAnnotation
{
    public function getParameter(): string
    {
        return EagerGlobalOrdinalsParameter::FRIENDLY_ID;
    }
}
