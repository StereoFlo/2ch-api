<?php

declare(strict_types = 1);

namespace App\Mapper\Board;

use Phpach\Threads\Board;

final class BoardMapper
{
    private ThreadMapper $threadMapper;

    public function __construct(ThreadMapper $threadMapper)
    {
        $this->threadMapper = $threadMapper;
    }

    /**
     * @return array<string, mixed>
     */
    public function map(Board $board): array
    {
        return [
            'id'            => $board->getId(),
            'threads_count' => $board->count(),
            'threads'       => $this->threadMapper->mapCollection($board->getThreads()),
        ];
    }
}
