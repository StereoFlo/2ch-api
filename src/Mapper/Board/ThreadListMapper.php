<?php

namespace App\Mapper\Board;

use function array_map;

class ThreadListMapper
{
    public static function map(array $threads): array
    {
        $data = array_map([ThreadMapper::class, 'map'], $threads);

        $scores = array_column($data, 'score');

        array_multisort($scores, SORT_DESC, $data);

        return $data;
    }
}
