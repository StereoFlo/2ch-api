<?php

declare(strict_types = 1);

namespace App\Controller;

use Phpach\Phpach;

abstract class AbstractController
{
    protected Phpach $phpach;

    public function __construct(Phpach $phpach)
    {
        $this->phpach = $phpach;
    }
}
