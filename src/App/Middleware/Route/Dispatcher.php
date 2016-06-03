<?php
namespace App\Middleware\Route;

use DMS\TornadoHttp\TornadoHttp;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Middleware that dispatch the action middleware of de route requested
 *
 * @package App\Middleware
 */
class Dispatcher
{
    /**
     * @var array Definitions of routes
     */
    private $routes;

    /**
     * Constructor
     *
     * @param array $routes Definitions of routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }
    
    /**
     * Invocation
     *
     * Dispatch the middlewares of the route requested
     *
     * @param ServerRequestInterface $request Request
     * @param ResponseInterface $response Response
     * @param TornadoHttp $next Next Middleware - TornadoHttp container
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, TornadoHttp $next)
    {
        $index = $next->getMiddlewareIndex();
        
        $routeMiddlewares = $this->routes[$request->getAttribute('RoutesMiddlewaresKey')]['middlewares'];

        foreach ($routeMiddlewares as $middleware) {
            $next->add($middleware, null, null, ($index++));
        }
        
        return $next($request, $response);
    }
}
