<?php

namespace App\Mapper\Board;

use Phpach\Threads\Board;

class BoardMapper
{
    public function map(Board $board)
    {
        return $this->doMapping($board);
    }

    protected function doMapping(Board $board): array
    {
        return [
            'id' => $board->getId(),
            'threads_count' => $board->count(),
            'threads' => ThreadListMapper::map($board->getThreads())
        ];
    }
}
