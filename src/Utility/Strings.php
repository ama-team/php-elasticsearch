<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Utility;

class Strings
{
    public static function snakeToCamel(string $input): string
    {
        $callback = function ($match) {
            return mb_strtoupper(mb_substr($match[0], mb_strlen($match[0]) - 1));
        };
        return preg_replace_callback('~_+\w~u', $callback, trim($input, '_'));
    }

    public static function camelToSnake(string $input): string
    {
        $callback = function ($match) {
            return '_' . $match[0];
        };
        return mb_strtolower(preg_replace_callback('~(?!^)\p{Lu}+~u', $callback, $input));
    }
}
