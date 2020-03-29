<?php

namespace App\Mapper\BoardList;

use Phpach\Boards\Board;

class BoardMapper
{
    public static function map(Board $board): array
    {
        return [
            'id'       => $board->getId(),
            'name'     => $board->getName()
        ];
    }
}
