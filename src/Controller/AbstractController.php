<?php

declare(strict_types = 1);

namespace App\Controller;

use Phpach\Phpach;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractController
{
    protected Phpach $phpach;

    public function __construct(Phpach $phpach)
    {
        $this->phpach = $phpach;
    }

    /**
     * @param array<mixed> $data
     * @return JsonResponse
     */
    public function json(array $data): JsonResponse
    {
        return new JsonResponse($data);
    }
}
