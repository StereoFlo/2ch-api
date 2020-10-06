<?php

declare(strict_types = 1);

namespace App\Mapper\BoardThread;

use function array_map;

class FileListMapper
{
    public static function map(?array $files): ?array
    {
        if (empty($files)) {
            return null;
        }

        return array_map([FileMapper::class, 'map'], $files);
    }
}
