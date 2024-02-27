<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\UserDto;
use App\Service\GreetingsService;
use Symfony\Component\HttpFoundation\JsonResponse;

final readonly class UserGreetingsController
{
    public function greetUser(GreetingsService $greetingsService, UserDto $user): JsonResponse
    {
        // business logic
        $greeting = $greetingsService->getGreeting($user);

        // response
        return new JsonResponse(['greeting' => $greeting]);
    }
}