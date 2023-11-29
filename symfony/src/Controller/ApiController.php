<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class ApiController
{
    #[Route(path: '/api/ping', name: 'api-ping')]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['ack' => time()]);
    }
}