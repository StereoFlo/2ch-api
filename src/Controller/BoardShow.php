<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Mapper\Board\BoardMapper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1/board/{id}", methods={"GET"}, requirements={"id": "[a-zA-Z]+"})
 */
final class BoardShow extends AbstractController
{
    public function __invoke(BoardMapper $boardMapper, string $id): JsonResponse
    {
        $board = $this->phpach->getAllThreadsInBoard($id);

        return $this->json($boardMapper->map($board));
    }
}
