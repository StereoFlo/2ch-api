<?php

namespace App\Controller;

use App\Mapper\BoardList\BoardMapper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1/board/{id}/settings", methods={"GET"}, requirements={"id": ".*"})
 */
class BoardSettings extends AbstractController
{
    public function __invoke(BoardMapper $boardMapper, string $id)
    {
        $boards = $this->phpach->getAllBoards();

        $categoryTmp = null;

        foreach ($boards as $category) {
            foreach ($category->getBoards() as $board) {
                if ($board->getId() === $id) {
                    $categoryTmp = $board;
                    break;
                }
            }
        }

        return JsonResponse::create($boardMapper->map($categoryTmp));
    }
}
