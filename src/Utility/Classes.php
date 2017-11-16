<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Utility;

class Classes
{
    public static function normalizeAbsoluteName(string $className): string
    {
        return '\\' . ltrim($className, '\\');
    }
}
