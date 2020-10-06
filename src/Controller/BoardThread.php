<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Mapper\BoardThread\ThreadMapper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @Route("/v1/board/{boardId}/{threadId}", requirements={"boardId": ".*", "threadId": "\d+"}, methods={"GET"})
 */
final class BoardThread extends AbstractController
{
    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function __invoke(string $boardId, int $threadId): JsonResponse
    {
        $thread = $this->phpach->getThread($boardId, $threadId);

        return JsonResponse::create(ThreadMapper::map($thread));
    }
}
