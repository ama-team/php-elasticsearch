<?php

namespace AmaTeam\ElasticSearch\Utility;

class Arrays
{
    public static function remove(array $haystack, $item, int $limit = PHP_INT_MAX): array
    {
        $target = [];
        $counter = 0;
        foreach ($haystack as $key => $value) {
            if ($item !== $value || $counter >= $limit) {
                $target[$key] = $value;
                continue;
            }
            $counter++;
        }
        return $target;
    }
}
