<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Mapper\BoardList\CategoryMapper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1/board", methods={"GET"})
 */
final class BoardList extends AbstractController
{
    public function __invoke(CategoryMapper $categoryMapper): JsonResponse
    {
        $boards = $this->phpach->getAllBoards();

        return JsonResponse::create($categoryMapper->mapCollection($boards));
    }
}
