<?php

/**
 * Configuración de la cola de Middlewares
 */

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

return [
    [
        'middleware' => 'App\Middleware\ResponseEmitter'
    ],
    [
        'middleware' => 'App\Middleware\ErrorHandler'
    ],
    [
        'middleware' => ['App\Middleware\RouteDispacher', [require('routes.php')]]
    ],
    [
        'middleware' => function(RequestInterface $request, ResponseInterface $response, callable $next){
            $response->getBody()->write('Middleware Action 1 process<br />');
            return $next($request, $response);
        },
        'path'    => '/^\/api/',
        'methods' => ['GET']
    ],
    [
        'middleware' => function(RequestInterface $request, ResponseInterface $response, callable $next){
            /** @var \Psr\Http\Message\ResponseInterface $response */
            $response = $next($request, $response);
            $response->getBody()->write('Middleware Action 2 process<br />');
            return $response;
        },
    ],
    [
        'middleware' => function(RequestInterface $request, ResponseInterface $response, callable $next){
            /** @var \DMS\TornadoHttp\TornadoHttp $next */
            $conf = $next->getDI()->get('Config');
            $response->getBody()->write('Middleware Action 3 process - Application mode: ' . $conf->mode . '<br />');

            //throw new \Exception('Custom Error');

            return $next($request, $response);
        },
    ],
];
