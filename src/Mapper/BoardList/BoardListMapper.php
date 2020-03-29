<?php

namespace App\Mapper\BoardList;

use App\Mapper\BoardList\BoardMapper;
use function array_map;

class BoardListMapper
{
    public static function map(array $boards): array
    {
        return array_map([BoardMapper::class, 'map'], $boards);
    }
}
