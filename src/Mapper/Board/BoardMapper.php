<?php

namespace App\Mapper\Board;

use Phpach\Threads\Board;

class BoardMapper
{
    public static function map(Board $board)
    {
        return [
            'id' => $board->getId(),
            'threads_count' => $board->count(),
            'threads' => ThreadListMapper::map($board->getThreads())
        ];
    }
}
