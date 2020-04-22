<?php

namespace App\Mapper\Board;

use Phpach\Threads\Thread;

class ThreadMapper
{

    public function mapCollection(array $threads): array
    {
        $data = array_map([$this, 'doMapping'], $threads);

        $scores = array_column($data, 'score');

        array_multisort($scores, SORT_DESC, $data);

        return $data;
    }

    protected function doMapping(Thread $thread): array
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
