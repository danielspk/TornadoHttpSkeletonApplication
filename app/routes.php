<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Rutas de la Aplicación
 */

return [
    ['GET', '/', [
        'App\Module\Application\Middleware\IndexRoute',
        function(RequestInterface $request, ResponseInterface $response, callable $next){
            $response->getBody()->write('Action Middleware 2 process<br />');
            return $next($request, $response);
        },
        function(RequestInterface $request, ResponseInterface $response, callable $next){
            $response->getBody()->write('Action Middleware 3 process<br />');
            return $next($request, $response);
        }
    ]],
    ['GET', '/user/{id:\d+}/{name}'  , ['handler2', 'middlewareAuth', 'middlewareMailer']],
    ['GET', '/users/{id:\d+}[/{name}]', ['handler3', 'middlewareAuth', 'middlewareMailer']]
];
