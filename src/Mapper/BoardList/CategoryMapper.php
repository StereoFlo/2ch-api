<?php

declare(strict_types = 1);

namespace App\Mapper\BoardList;

use Phpach\Boards\Category;
use function array_map;

class CategoryMapper
{
    /**
     * @var BoardMapper
     */
    private $boardMapper;

    public function __construct(BoardMapper $boardMapper)
    {
        $this->boardMapper = $boardMapper;
    }

    public function map(Category $category): array
    {
        return $this->doMapping($category);
    }

    public function mapCollection(array $categories): array
    {
        return array_map([$this, 'doMapping'], $categories);
    }

    protected function doMapping(Category $category): array
    {
        return [
            'name'        => $category->getName(),
            'board_count' => $category->count(),
            'boards'      => $this->boardMapper->mapCollection($category->getBoards()),
        ];
    }
}
