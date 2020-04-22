<?php

namespace App\Mapper\Board;

use Phpach\Threads\Board;

class BoardMapper
{
    /**
     * @var ThreadMapper
     */
    private $threadMapper;

    public function __construct(ThreadMapper $threadMapper)
    {
        $this->threadMapper = $threadMapper;
    }

    public function map(Board $board)
    {
        return $this->doMapping($board);
    }

    protected function doMapping(Board $board): array
    {
        return [
            'id'            => $board->getId(),
            'threads_count' => $board->count(),
            'threads'       => $this->threadMapper->mapCollection($board->getThreads())
        ];
    }
}
