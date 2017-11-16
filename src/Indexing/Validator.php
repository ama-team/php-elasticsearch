<?php

namespace AmaTeam\ElasticSearch\Indexing;

use AmaTeam\ElasticSearch\API\Indexing\Validation\ContextInterface;
use AmaTeam\ElasticSearch\API\Indexing\ValidatorInterface;
use AmaTeam\ElasticSearch\API\IndexingInterface;
use AmaTeam\ElasticSearch\Indexing\Option\Infrastructure\Registry;
use AmaTeam\ElasticSearch\Indexing\Validation\Constraint\ValidOptionName;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

class Validator implements ValidatorInterface
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @param Registry $registry
     */
    public function __construct(Registry $registry = null)
    {
        $this->registry = $registry ?? Registry::getInstance();
    }

    public function validate(
        IndexingInterface $indexing,
        ContextInterface $context = null
    ): ConstraintViolationListInterface {
        $validator = Validation::createValidator()->startContext();
        foreach ($indexing->getOptions() as $name => $value) {
            $validator->atPath($name);
            $option = $this->registry->find($name);
            if (!$option && $context->shouldPreserveUnknownOptions()) {
                continue;
            }
            $validator->validate($name, [new ValidOptionName()]);
            if (!$option) {
                continue;
            }
            $constraints = $option->getConstraints();
            if ($option->allowsNullValue()) {
                $constraints[] = new NotNull();
            }
            $validator->validate($value, $constraints);
        }
        return $validator->getViolations();
    }
}
