<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function time;

class PingHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $myRequestTime = $request->getAttribute('x-my-request-time');

        return new JsonResponse(
            data: ['ack' => time()],
            headers: ['x-has-attribute-added-from-middleware' => (!!$myRequestTime) ? 'yes' : 'no']
        );
    }
}
