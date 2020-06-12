<?php

namespace App\Controller;

use App\Mapper\Board\BoardMapper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @Route("/v1/board/{id}", requirements={"id": ".*"}, methods={"GET"}, requirements={"id": "\s+"})
 */
class Board extends AbstractController
{
    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function __invoke(BoardMapper $boardMapper, string $id): JsonResponse
    {
        $board = $this->phpach->getAllThreadsInBoard($id);

        return JsonResponse::create($boardMapper->map($board));
    }
}
