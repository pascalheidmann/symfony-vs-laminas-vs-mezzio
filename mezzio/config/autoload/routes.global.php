<?php

declare(strict_types=1);

return [
    'dependencies' => [
        'delegators' => [
            \Mezzio\Application::class => [
                \Mezzio\Container\ApplicationConfigInjectionDelegator::class,
            ],
        ],
    ],
    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => [
                \App\Handler\HomePageHandler::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => [
                \App\Middleware\AddAdditionalInfoMiddleware::class,
                \App\Handler\PingHandler::class
            ],
            'allowed_methods' => ['GET'],
        ],
    ],
];