<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Mapper\BoardList\BoardMapper;
use DomainException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1/board/{id}/settings", methods={"GET"}, requirements={"id": ".*"})
 */
final class BoardSettings extends AbstractController
{
    public function __invoke(BoardMapper $boardMapper, string $id): JsonResponse
    {
        $boards = $this->phpach->getAllBoards();

        //todo уьрать в отдельный сервис
        $categoryTmp = null;

        foreach ($boards as $category) {
            foreach ($category->getBoards() as $board) {
                if ($board->getId() === $id) {
                    $categoryTmp = $board;

                    break;
                }
            }
        }

        if (empty($categoryTmp)) {
            throw new DomainException('list of categories ia empty');
        }

        return new JsonResponse($boardMapper->map($categoryTmp));
    }
}
