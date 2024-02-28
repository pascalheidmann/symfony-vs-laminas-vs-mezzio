<?php

declare(strict_types=1);

namespace App\ExternalApi\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController
{
    public function __invoke(): JsonResponse
    {
        // business logic

        return new JsonResponse(['ack' => time()]);
    }
}