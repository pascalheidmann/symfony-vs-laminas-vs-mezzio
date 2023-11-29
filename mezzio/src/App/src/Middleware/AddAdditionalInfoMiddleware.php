<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Service\TimeService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AddAdditionalInfoMiddleware implements MiddlewareInterface
{
    public function __construct(
        private TimeService $timeService,
    ) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $modifiedRequest = $request->withAttribute('x-my-request-time', $this->timeService->now());
        $response = $handler->handle($modifiedRequest);

        return $response->withAddedHeader('X-I-Added-My-Header', base64_encode(random_bytes(64)));
    }
}