<?php

namespace AmaTeam\ElasticSearch\Mapping\Type\Parameter;

use AmaTeam\ElasticSearch\Mapping\Type\Parameter\Infrastructure\AbstractParameter;
use Symfony\Component\Validator\Constraints\Choice;

class PrecisionParameter extends AbstractParameter
{
    const ID = 'precision';
    const FRIENDLY_ID = self::ID;

    const VALUE_IN = 'in';
    const VALUE_INCH = 'inch';
    const VALUE_YD = 'yd';
    const VALUE_YARD = 'yard';
    const VALUE_MI = 'mi';
    const VALUE_MILES = 'miles';
    const VALUE_KM = 'km';
    const VALUE_KILOMETERS = 'kilometers';
    const VALUE_M = 'm';
    const VALUE_METERS = 'meters';
    const VALUE_CM = 'cm';
    const VALUE_CENTIMETERS = 'centimeters';
    const VALUE_MM = 'mm';
    const VALUE_MILLIMETERS = 'millimeters';

    public function getId(): string
    {
        return self::ID;
    }

    public function getConstraints(): array
    {
        $values = [
            self::VALUE_IN => 'in',
            self::VALUE_INCH => 'inch',
            self::VALUE_YD => 'yd',
            self::VALUE_YARD => 'yard',
            self::VALUE_MI => 'mi',
            self::VALUE_MILES => 'miles',
            self::VALUE_KM => 'km',
            self::VALUE_KILOMETERS => 'kilometers',
            self::VALUE_M => 'm',
            self::VALUE_METERS => 'meters',
            self::VALUE_CM => 'cm',
            self::VALUE_CENTIMETERS => 'centimeters',
            self::VALUE_MM => 'mm',
            self::VALUE_MILLIMETERS => 'millimeters',
        ];
        return [new Choice(['strict' => true, 'choices' => $values])];
    }
}
