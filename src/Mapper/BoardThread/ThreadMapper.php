<?php

namespace App\Mapper\BoardThread;

use DomainException;
use Phpach\Thread\Thread;

class ThreadMapper
{
    public static function map(Thread $thread): array
    {
        $res = [
            'title'          => $thread->getTitle(),
            'id'             => $thread->getBoardId(),
            'name'           => $thread->getBoardName(),
            'info'           => $thread->getBoardName(),
            'post_count'     => $thread->getPostCount(),
            'unique_posters' => $thread->getUniquePosters(),
            'thread_count'   => $thread->count(),
        ];

        if ($thread->count() > 1) {
            throw new DomainException('check thread count');
        }

        $threads = $thread->getThreads();

        $posts = [];

        if ($threads[0]->count()) {
            foreach ($threads[0]->getPosts() as $post) {
                $posts[] = [
                    'id'      => $post->getNumber(),
                    'num'     => $post->getNum(),
                    'name'    => $post->getName(),
                    'comment' => $post->getComment(),
                    'files'   => FileListMapper::map($post->getFiles()),
                ];
            }
        }

        $res['posts'] = $posts;

        return $res;
    }
}
