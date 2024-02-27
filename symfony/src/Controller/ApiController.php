<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{
    public function __invoke(): JsonResponse
    {
        // business logic

        return new JsonResponse(['ack' => time()]);
    }
}