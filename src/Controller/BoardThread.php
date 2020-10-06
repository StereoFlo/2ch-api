<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Mapper\BoardThread\ThreadMapper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1/board/{boardId}/{threadId}", requirements={"boardId": "\s+", "threadId": "\d+"}, methods={"GET"})
 */
final class BoardThread extends AbstractController
{
    public function __invoke(string $boardId, int $threadId): JsonResponse
    {
        $thread = $this->phpach->getThread($boardId, $threadId);

        return JsonResponse::create(ThreadMapper::map($thread));
    }
}
