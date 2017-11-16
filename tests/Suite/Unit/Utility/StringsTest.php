<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Test\Suite\Unit\Utility;

use AmaTeam\ElasticSearch\Utility\Strings;
use Codeception\Test\Unit;
use PHPUnit\Framework\Assert;

class StringsTest extends Unit
{
    public function camelToSnakeDataProvider()
    {
        return [
            ['', ''],
            ['camel_case', 'camel_case'],
            ['camelCase', 'camel_case'],
            ['CamelCase', 'camel_case'],
            ['camelCAse', 'camel_case'],
            ['_source', '_source'],
        ];
    }

    public function snakeToCamelDataProvider()
    {
        return [
            ['', ''],
            ['snake_case', 'snakeCase'],
            ['_snake_case_', 'snakeCase'],
            ['snake___case', 'snakeCase']
        ];
    }

    /**
     * @param string $input
     * @param string $expectation
     *
     * @dataProvider camelToSnakeDataProvider
     * @test
     */
    public function shouldConvertCamelCaseToSnakeCase(string $input, string $expectation)
    {
        Assert::assertEquals($expectation, Strings::camelToSnake($input));
    }

    /**
     * @param string $input
     * @param string $expectation
     *
     * @dataProvider snakeToCamelDataProvider
     * @test
     */
    public function shouldConvertSnakeCaseToCamelCase(string $input, string $expectation)
    {
        Assert::assertEquals($expectation, Strings::snakeToCamel($input));
    }
}
