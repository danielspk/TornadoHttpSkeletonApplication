<?php
namespace App;

use DMS\TornadoHttp\TornadoHttp;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response;
use Pimple\Container;

require '../app/vendor/autoload.php';

$mid1 = function (RequestInterface $request, ResponseInterface $response, callable $next) {
    $response->getBody()->write(' Middleware 1 ');
    return $next($request, $response);
};

$mid2 = function (RequestInterface $request, ResponseInterface $response, callable $next) {
    $response = $next($request, $response);
    $response->getBody()->write(' Middleware 2 ');
    return $response;
};

$mid3 = function (RequestInterface $request, ResponseInterface $response, callable $next) {
    $conf = $next->getConfig();
    $response->getBody()->write(' Middleware 3 ' . $conf['hello'] . ' ');

    //throw new \Exception('Custom Error');

    return $next($request, $response);
};

$app = new TornadoHttp([
    'App\Middleware\ResponseEmitter',
    'App\Middleware\ErrorHandler',
    ['App\Middleware\ConfigLoader', [['../app/src/config.php', 'not found']]],
    ['App\Middleware\ServiceContainer', [['../app/src/services.php', 'not found']]],
    ['App\Middleware\RouteContainer', [['../app/src/routes.php', 'not found']]],
    $mid1,
    $mid2
]);

$app->add($mid3);

$app->setConfig(new Middleware\Helper\Config());

$app->setDI(new Container());

$app->setExceptionHandler(function (RequestInterface $request, ResponseInterface $response, callable $next, \Exception $e) {

    $response = new Response();
    $response = $response->withStatus(500);
    $response->getBody()->write('Personal Error: ' . $e->getMessage() . ', ' . $e->getFile());

    return $response;

});

$conf = $app->getConfig();
$conf['hello'] = ' config value HELLO ';

$app(ServerRequestFactory::fromGlobals(), new Response());