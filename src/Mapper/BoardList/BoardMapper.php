<?php

namespace App\Mapper\BoardList;

use Phpach\Boards\Board;

class BoardMapper
{
    public function map(Board $board): array
    {
        return $this->doMapping($board);
    }

    public function mapCollection(array $boards): array
    {
        return array_map([BoardMapper::class, 'doMapping'], $boards);
    }

    protected function doMapping(Board $board): array
    {
        return [
            'id'   => $board->getId(),
            'name' => $board->getName()
        ];
    }
}
