<?php

declare(strict_types=1);

namespace ExternalApi;

use BusinessDomain\Service\TimeService;
use ExternalApi\Middleware\AddAdditionalInfoMiddleware;
use ExternalApi\Middleware\UserDtoParamConverterMiddleware;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Mezzio\Helper\BodyParams\BodyParamsMiddleware;
use Psr\Container\ContainerInterface;

/**
 * The configuration provider for the ExternalApi module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'routes' => $this->getRoutes(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                \ExternalApi\Handler\PingHandler::class => \ExternalApi\Handler\PingHandler::class,
            ],
            'factories' => [
                \ExternalApi\Handler\HomePageHandler::class => \ExternalApi\Handler\Factory\HomePageHandlerFactory::class,
                \ExternalApi\Handler\UserGreetingsHandler::class => \ExternalApi\Handler\Factory\UserGreetingsHandlerFactory::class,

                \ExternalApi\Middleware\AddAdditionalInfoMiddleware::class => static fn(ContainerInterface $container) => new AddAdditionalInfoMiddleware($container->get(TimeService::class)),
                \ExternalApi\Middleware\UserDtoParamConverterMiddleware::class => InvokableFactory::class,
            ],
        ];
    }

    private function getRoutes(): array
    {
        return [
            [
                'name' => 'home',
                'path' => '/',
                'middleware' => [
                    \ExternalApi\Handler\HomePageHandler::class,
                ],
                'allowed_methods' => ['GET'],
            ],
            [
                'name' => 'api.ping',
                'path' => '/api/ping',
                'middleware' => [
                    \ExternalApi\Middleware\AddAdditionalInfoMiddleware::class,
                    \ExternalApi\Handler\PingHandler::class
                ],
                'allowed_methods' => ['GET'],
            ],
            [
                'name' => 'greetings',
                'path' => '/api/greetings',
                'middleware' => [
                    \Mezzio\Helper\BodyParams\BodyParamsMiddleware::class,
                    \ExternalApi\Middleware\UserDtoParamConverterMiddleware::class,
                    \ExternalApi\Handler\UserGreetingsHandler::class
                ],
                'allowed_methods' => ['POST'],
            ],
        ];
    }
}
