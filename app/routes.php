<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Rutas de la Aplicación
 */

return [
    ['GET', '/', [
        'App\Module\Application\ActionRoute\IndexAction',
        function(RequestInterface $request, ResponseInterface $response, callable $next){
            $response->getBody()->write('Ruta Principal 1');
            return $next($request, $response);
        },
        function(RequestInterface $request, ResponseInterface $response, callable $next){
            $response->getBody()->write('Ruta Principal 2');
            return $next($request, $response);
        }
    ]],
    ['GET', '/user/{id:\d+}/{name}'  , ['handler2', 'middlewareAuth', 'middlewareMailer']],
    ['GET', '/users/{id:\d+}[/{name}]', ['handler3', 'middlewareAuth', 'middlewareMailer']]
];
