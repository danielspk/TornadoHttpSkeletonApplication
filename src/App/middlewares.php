<?php

/**
 * Configuration of the Middlewares queue
 */

$middlewareBasePath    = $container->get('Config')->{'base.path'};
$middlewareBasePathExp = str_replace('/', '\/', $middlewareBasePath);

return [
    [
        'middleware' => App\Middleware\Response\SapiEmitter::class
    ],
    [
        'middleware' => App\Middleware\Exception\Handler::class,
    ],
    [
        'middleware' => [App\Middleware\Request\BasePath::class, [$middlewareBasePath]]
    ],
    [
        'middleware' => App\Middleware\Request\BodyParse::class,
    ],
    [
        'middleware' => [App\Middleware\Router\Resolver::class, [require 'routes.php']]
    ],
    [
        'middleware' => App\Middleware\Auth\Jwt::class,
        'path'       => '/^'.$middlewareBasePathExp.'api\/v1/'
    ],
    [
        'middleware' => [App\Middleware\Router\Dispatcher::class, [require 'routes.php']]
    ]
];
