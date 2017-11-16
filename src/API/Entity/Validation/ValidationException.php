<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\API\Entity\Validation;

use RuntimeException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends RuntimeException
{
    /**
     * @var ConstraintViolationListInterface
     */
    private $violations;

    /**
     * @inheritDoc
     */
    public function __construct($message, ConstraintViolationListInterface $violations)
    {
        parent::__construct($message);
        $this->violations = $violations;
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}
