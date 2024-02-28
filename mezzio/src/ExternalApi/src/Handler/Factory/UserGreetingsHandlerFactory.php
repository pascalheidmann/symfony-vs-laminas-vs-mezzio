<?php

declare(strict_types=1);

namespace ExternalApi\Handler\Factory;

use BusinessDomain\Service\GreetingsService;
use ExternalApi\Handler\UserGreetingsHandler;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UserGreetingsHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        return new UserGreetingsHandler($container->get(GreetingsService::class));
    }
}
