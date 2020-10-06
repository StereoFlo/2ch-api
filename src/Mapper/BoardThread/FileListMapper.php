<?php

declare(strict_types = 1);

namespace App\Mapper\BoardThread;

use Phpach\Thread\File;
use function array_map;

final class FileListMapper
{
    /**
     * @param array<File>|null $files
     *
     * @return array<array<string, mixed>>
     */
    public static function map(?array $files): array
    {
        if (empty($files)) {
            return [];
        }

        return array_map([FileMapper::class, 'map'], $files);
    }
}
