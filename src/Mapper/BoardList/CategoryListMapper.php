<?php

namespace App\Mapper\BoardList;

use function array_map;

class CategoryListMapper
{
    public static function map(array $categories): array
    {
        return array_map([CategoryMapper::class, 'map'], $categories);
    }
}
