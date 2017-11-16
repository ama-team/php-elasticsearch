<?php

namespace AmaTeam\ElasticSearch\Test\Support\Entity\Acceptance\Business;

use AmaTeam\ElasticSearch\API\Mapping;
use AmaTeam\ElasticSearch\Mapping\Operations;
use AmaTeam\ElasticSearch\Mapping\Type\DateType;
use AmaTeam\ElasticSearch\Mapping\Type\FloatType;
use AmaTeam\ElasticSearch\Mapping\Type\IntegerType;
use AmaTeam\ElasticSearch\Mapping\Type\KeywordType;
use AmaTeam\ElasticSearch\Mapping\Type\NestedType;
use AmaTeam\ElasticSearch\Mapping\Type\ObjectType;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DocValuesParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\DynamicParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexOptionsParameter;
use AmaTeam\ElasticSearch\Mapping\Type\Parameter\IndexParameter;
use AmaTeam\ElasticSearch\Mapping\Type\RootType;
use AmaTeam\ElasticSearch\Mapping\Type\TextType;

class MappingProvider
{
    /**
     * @return Mapping[]
     */
    public static function getMapping(): array
    {
        $rating = (new Mapping(ObjectType::ID))
            ->setParameter(DynamicParameter::ID, DynamicParameter::VALUE_TRUE)
            ->setProperties([
                'overall' => new Mapping(FloatType::ID),
                'month' => new Mapping(FloatType::ID),
                'year' => new Mapping(FloatType::ID)
            ]);
        $id = (new Mapping(IntegerType::ID))->setParameter(IndexParameter::ID, false);
        $title = (new Mapping(TextType::ID))->setParameter(IndexOptionsParameter::ID, IndexOptionsParameter::VALUE_OFFSETS);
        $name = (new Mapping(TextType::ID))->setParameter(IndexOptionsParameter::ID, IndexOptionsParameter::VALUE_OFFSETS);
        $department = (new Mapping(NestedType::ID))
            ->setParameter(DynamicParameter::ID, DynamicParameter::VALUE_FALSE)
            ->setProperties([
                'id' => $id,
                'title' => $title
            ]);
        $employee = (new Mapping(NestedType::ID))
            ->setParameter(DynamicParameter::ID, DynamicParameter::VALUE_FALSE)
            ->setProperties([
                'id' => $id,
                'firstName' => $name,
                'middleName' => $name,
                'lastName' => $name,
                'joinedAt' => (new Mapping(DateType::ID))
            ]);
        $manager = Operations::from($employee)
            ->removeProperty('joinedAt')
            ->setProperty(
                'capabilities',
                (new Mapping(KeywordType::ID))
                    ->setParameter(DocValuesParameter::ID, true)
            );
        $organization = (new Mapping(NestedType::ID))
            ->setParameter(DynamicParameter::ID, DynamicParameter::VALUE_FALSE)
            ->setProperties([
                'id' => $id,
                'title' => $title
            ]);

        return [
            'department' => Operations::merge(
                $department,
                (new Mapping(RootType::ID))
                    ->setProperties([
                        'rating' => $rating,
                        'organization' => Operations::merge($organization, new Mapping(ObjectType::ID))
                    ])
            ),
            'employee' => Operations::merge(
                $employee,
                (new Mapping(RootType::ID))
                    ->setProperty(
                        'department',
                        Operations::merge(
                            $department,
                            (new Mapping(ObjectType::ID))
                                ->setParameter(DynamicParameter::ID, DynamicParameter::VALUE_TRUE)
                        )
                    )
                    ->setProperty('rating', $rating)
            ),
            'manager' => Operations::merge(
                $manager,
                (new Mapping(RootType::ID))
                    ->setProperty(
                        'department',
                        Operations::merge(
                            $department,
                            (new Mapping(ObjectType::ID))
                                ->setParameter(DynamicParameter::ID, DynamicParameter::VALUE_TRUE)
                        )
                    )
                    ->setProperty('rating', $rating)
            ),
            'organization' => Operations::merge(
                $organization,
                (new Mapping(RootType::ID))
                    ->setProperties([
                        'departments' => Operations::merge($department, new Mapping(ObjectType::ID)),
                        'rating' => Operations::merge($rating, new Mapping(ObjectType::ID))
                    ])
            )
        ];
    }
}
