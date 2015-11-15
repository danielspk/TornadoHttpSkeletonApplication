<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Rutas de la Aplicación
 */

return [
    ['GET', '/', [
        'App\Module\Application\Action\IndexAction',
        function(RequestInterface $request, ResponseInterface $response, callable $next){
            $response->getBody()->write('Route Action 2 process<br />');
            return $next($request, $response);
        },
        function(RequestInterface $request, ResponseInterface $response, callable $next){
            $response->getBody()->write('Route Action 3 process<br />');
            return $next($request, $response);
        }
    ]],
    ['GET', '/user/{id:\d+}/{name}'   , ['ExampleUserGetAction', 'OtherA', 'OtherB']],
    ['GET', '/users/{id:\d+}[/{name}]', ['ExampleUsersGetAction', 'OtherC', 'OtherD']]
];
