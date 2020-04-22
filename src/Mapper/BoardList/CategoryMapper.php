<?php

namespace App\Mapper\BoardList;

use Phpach\Boards\Category;

class CategoryMapper
{
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
            'boards'      => BoardListMapper::map($category->getBoards())
        ];
    }
}
