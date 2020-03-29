<?php

namespace App\Mapper\BoardList;

use App\Mapper\BoardList\BoardListMapper;
use Phpach\Boards\Category;

class CategoryMapper
{
    public static function map(Category $category): array
    {
        return [
            'name' => $category->getName(),
            'board_count' => $category->count(),
            'boards' => BoardListMapper::map($category->getBoards())
        ];
    }
}
