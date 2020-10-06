<?php

declare(strict_types = 1);

namespace App\Mapper\BoardList;

use Phpach\Boards\Board;
use function array_map;

final class BoardMapper
{
    /**
     * @return array<string, mixed>
     */
    public function map(Board $board): array
    {
        return [
            'id'   => $board->getId(),
            'name' => $board->getName(),
        ];
    }

    /**
     * @param Board[] $boards
     *
     * @return array<array<string, mixed>>
     */
    public function mapCollection(array $boards): array
    {
        return array_map([BoardMapper::class, 'map'], $boards);
    }
}
