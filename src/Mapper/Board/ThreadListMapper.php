<?php

namespace App\Mapper\Board;

class ThreadListMapper
{
    public static function map(array $threads): array
    {
        return \array_map([ThreadMapper::class, 'map'], $threads);
    }
}
