<?php

declare(strict_types = 1);

namespace App\Mapper\BoardThread;

use DomainException;
use Phpach\Thread\Thread;

final class ThreadMapper
{
    /**
     * @return array<string, mixed>
     */
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

        if (isset($threads[0]) && $threads[0]->count()) {
            foreach ($threads[0]->getPosts() as $post) {
                $posts[] = [
                    'id'      => $post->getNumber(),
                    'num'     => $post->getNum(),
                    'name'    => $post->getName(),
                    'comment' => $post->getComment(),
                    'parent'  => $post->getParent(),
                    'files'   => FileListMapper::map($post->getFiles()),
                ];
            }
        }

        $res['posts'] = $posts;

        return $res;
    }
}
