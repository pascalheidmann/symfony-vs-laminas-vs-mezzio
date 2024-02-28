<?php

declare(strict_types=1);

namespace ExternalApi\Middleware;

use BusinessDomain\Dto\UserDto;
use DateTimeImmutable;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class UserDtoParamConverterMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $payload = $request->getParsedBody();
        assert(is_array($payload));

        return $handler->handle(
            $request->withAttribute(
                UserDto::class,
                new UserDto($payload['name'], new DateTimeImmutable($payload['birthday']))
            )
        );
    }
}