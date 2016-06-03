<?php
namespace App\Middleware\route;

use App\Exception\HttpMethodNotAllowedException;
use App\Exception\HttpNotFoundException;
use DMS\TornadoHttp\TornadoHttp;
use FastRoute;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Middleware that resolve the request of the route
 *
 * @package App\Middleware
 */
class Resolver
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
     * Register routes container and request attributes
     *
     * @param ServerRequestInterface $request Request
     * @param ResponseInterface $response Response
     * @param TornadoHttp $next Next Middleware - TornadoHttp container
     * @return ResponseInterface
     * @throws HttpMethodNotAllowedException
     * @throws HttpNotFoundException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, TornadoHttp $next)
    {
        /** @var \FastRoute\Dispatcher\GroupCountBased $dispatcher */

        $dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $routeCollector) {
            foreach ($this->routes as $key => $route) {
                $routeCollector->addRoute($route['methods'], $route['path'], $key);
            }
        });

        $method  = $request->getMethod();
        $uri     = rawurldecode(parse_url($request->getUri(), \PHP_URL_PATH));
        $route   = $dispatcher->dispatch($method, $uri);
        $handler = null;
        $vars    = null;

        switch ($route[0]) {
            case Dispatcher::NOT_FOUND:
                throw new HttpNotFoundException('Inexistent route for the url '.$request->getUri());
            case Dispatcher::METHOD_NOT_ALLOWED:
                throw new HttpMethodNotAllowedException('Method not allowed');
            case Dispatcher::FOUND:
                $handler = $route[1];
                $vars = $route[2];
                break;
        }

        $request = $request->withAttribute('RoutesMiddlewaresKey', $handler);

        foreach ($vars as $name => $value) {
            $request = $request->withAttribute($name, $value);
        }

        return $next($request, $response);
    }
}
