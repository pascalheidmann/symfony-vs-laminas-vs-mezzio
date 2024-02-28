<?php
declare(strict_types=1);

namespace App\ExternalApi\Listener;

use BusinessDomain\Service\TimeService;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class RequestListener
{
    public function __construct(
        private TimeService $timeService,
    )
    {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        // add attribute
        $request->attributes->set('x-my-request-time', $this->timeService->now());
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        if (!$event->isMainRequest()) {
            // don't do anything if it's not the master request
            return;
        }

        $response = $event->getResponse();

        // set single header
        $response->headers->set('X-I-Added-My-Header', base64_encode(random_bytes(64)));
    }
}