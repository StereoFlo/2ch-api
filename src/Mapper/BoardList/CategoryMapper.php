<?php

declare(strict_types = 1);

namespace App\Mapper\BoardList;

use Phpach\Boards\Category;
use function array_map;

final class CategoryMapper
{
    private BoardMapper $boardMapper;

    public function __construct(BoardMapper $boardMapper)
    {
        $this->boardMapper = $boardMapper;
    }

    /**
     * @return array<string, mixed>
     */
    public function map(Category $category): array
    {
        return [
            'name'        => $category->getName(),
            'board_count' => $category->count(),
            'boards'      => $this->boardMapper->mapCollection($category->getBoards()),
        ];
    }

    /**
     * @param Category[] $categories
     *
     * @return array<array<string, mixed>>
     */
    public function mapCollection(array $categories): array
    {
        return array_map([$this, 'map'], $categories);
    }
}
