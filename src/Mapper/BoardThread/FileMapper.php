<?php

declare(strict_types = 1);

namespace App\Mapper\BoardThread;

use Phpach\Thread\File;

class FileMapper
{
    public static function map(File $file): array
    {
        return [
            'display_name' => $file->getDisplayName(),
            'height'       => $file->getHeight(),
            'width'        => $file->getWidth(),
            'size'         => $file->getSize(),
            'path'         => $file->getPath(),
            'thumbnail'    => $file->getThumbnail(),
        ];
    }
}
