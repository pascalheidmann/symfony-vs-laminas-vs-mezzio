<?php

declare(strict_types=1);

namespace BusinessDomain;

use BusinessDomain\Service\GreetingsService;
use BusinessDomain\Service\TimeService;
use Laminas\ServiceManager\Factory\InvokableFactory;
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
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'factories' => [
                TimeService::class => InvokableFactory::class,
                GreetingsService::class => static fn(ContainerInterface $container) => new GreetingsService($container->get(TimeService::class)),
            ],
        ];
    }
}
