<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Mapping\Type;

use Symfony\Component\Validator\Constraint;

interface ParameterInterface
{
    public function getId(): string;
    public function getFriendlyId(): string;

    /**
     * @return Constraint[]
     */
    public function getConstraints(): array;

    /**
     * @return bool
     */
    public function nullValueAllowed(): bool;
}
