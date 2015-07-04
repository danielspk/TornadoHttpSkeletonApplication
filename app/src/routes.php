<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

return [
    ['GET', '/', [
        'App\Modules\Application\RouteAction\IndexAction',
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