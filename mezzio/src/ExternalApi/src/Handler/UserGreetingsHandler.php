<?php

declare(strict_types=1);

namespace ExternalApi\Handler;

use BusinessDomain\Dto\UserDto;
use BusinessDomain\Service\GreetingsService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class UserGreetingsHandler implements RequestHandlerInterface
{
    public function __construct(private GreetingsService $greetingsService)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // business logic
        $user = $request->getAttribute(UserDto::class);
        assert($user instanceof UserDto);

        $greeting = $this->greetingsService->getGreeting($user);

        // response
        return new JsonResponse(['greeting' => $greeting]);
    }
}