<?php

/**
 * Configuration of the Middlewares queue
 */

$middlewareBasePath    = $container->get('Config')->{'base.path'};
$middlewareBasePathExp = str_replace('/', '\/', $middlewareBasePath);

return [
    [
        'middleware' => App\Middleware\ResponseEmitter::class
    ],
    [
        'middleware' => App\Middleware\ErrorHandler::class,
    ],
    [
        'middleware' => [App\Middleware\BasePath::class, [$middlewareBasePath]]
    ],
    [
        'middleware' => App\Middleware\BodyParse::class,
    ],
    [
        'middleware' => [App\Middleware\Route\Resolver::class, [require 'routes.php']]
    ],
    [
        'middleware' => App\Middleware\Auth\Jwt::class,
        'path'       => '/^'.$middlewareBasePathExp.'api\/v1/'
    ],
    [
        'middleware' => [App\Middleware\Route\Dispatcher::class, [require 'routes.php']]
    ]
];
