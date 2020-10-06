<?php

declare(strict_types = 1);

namespace App\Mapper\BoardList;

use Phpach\Boards\Board;
use function array_map;

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
            'name' => $board->getName(),
        ];
    }
}
