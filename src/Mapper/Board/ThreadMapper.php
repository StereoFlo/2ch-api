<?php

namespace App\Mapper\Board;

use Phpach\Threads\Thread;

class ThreadMapper
{
    public static function map(Thread $thread): array
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
