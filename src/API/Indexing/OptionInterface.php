<?php

namespace AmaTeam\ElasticSearch\API\Indexing;

use Symfony\Component\Validator\Constraint;

interface OptionInterface
{
    public function getId(): string;
    public function getFriendlyId(): string;

    /**
     * @return Constraint[]
     */
    public function getConstraints(): array;
    public function allowsNullValue(): bool;
}
