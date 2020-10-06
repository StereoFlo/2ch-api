<?php

declare(strict_types = 1);

namespace App\Mapper\Board;

use Phpach\Threads\Thread;
use function array_column;
use function array_map;
use function array_multisort;

final class ThreadMapper
{
    /**
     * @param Thread[] $threads
     *
     * @return array<array<string, mixed>>
     */
    public function mapCollection(array $threads): array
    {
        $data = array_map([$this, 'map'], $threads);

        $scores = array_column($data, 'score');

        array_multisort($scores, \SORT_DESC, $data);

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    public function map(Thread $thread): array
    {
        return [
            'comment'    => $thread->getComment(),
            'subject'    => $thread->getSubject(),
            'timestamp'  => $thread->getTimestamp(),
            'lasthit'    => $thread->getLasthit(),
            'post_count' => $thread->getPostsCount(),
            'score'      => $thread->getScore(),
            'num'        => $thread->getNum(),
            'views'      => $thread->getViews(),
        ];
    }
}
