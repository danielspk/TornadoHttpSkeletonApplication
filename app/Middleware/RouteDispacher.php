<?php
namespace App\Middleware;

use DMS\TornadoHttp\TornadoHttp;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use FastRoute;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

/**
 * Clase Middleware que registra las rutas en su contenedor y despacha la petición a una ruta
 *
 * @package App\Middleware
 */
class RouteDispacher {

    /**
     * @var array Definición de rutas
     */
    private $routes;

    /**
     * Constructor
     *
     * @param array $pRoutes Definición de rutas
     */
    public function __construct(array $pRoutes)
    {
        $this->routes = $pRoutes;
    }

    /**
     * Invocación de registración de contenedor de rutas y despacho de petición
     *
     * @param RequestInterface $pRequest Petición
     * @param ResponseInterface $pResponse Respuesta
     * @param callable $pNext Próximo Middleware
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext)
    {
        $dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {

            foreach($this->routes as $route) {
                $r->addRoute($route[0], $route[1], $route[2]);
            }

        });

        // se elimina el document root del path del request para que coincida con la ruta
        /** @var \DMS\TornadoHttp\TornadoHttp $pNext */
        /** @var \League\Container\Container $container */
        /** @var \App\Provider\Helper\Config $config */
        $container = $pNext->getDI();
        $config = $container->get('config');
        $uri = '/' . str_ireplace($config['document.root'], '', $pRequest->getUri()->getPath());
        $route = $dispatcher->dispatch($pRequest->getMethod(), $uri);

        switch ($route[0]) {
            case Dispatcher::NOT_FOUND:
                return $pResponse->withStatus(404); // Mejoras posibles: crear tipo de Excepción 404
            case Dispatcher::METHOD_NOT_ALLOWED:
                return $pResponse->withStatus(405); // Mejoras posibles: crear tipo de Excepción 405
            case Dispatcher::FOUND:
                $handler = $route[1];
                $vars = $route[2];
                break;
        }

        foreach ($vars as $name => $value) {
            $pRequest = $pRequest->withAttribute($name, $value);
        }

        $this->executeRoute($pNext, $handler);

        return $pNext($pRequest, $pResponse);
    }

    /**
     * Método que registra los middlewares de la ruta despachada detras del indice actual de la cola de ejecución
     *
     * @param TornadoHttp $pApp
     * @param array $pHandler
     * @return ResponseInterface
     */
    public function executeRoute($pApp, $pHandler)
    {
        $middlewares = $pApp->getMiddlewares();
        $index = $middlewares->key();

        foreach ($pHandler as $middlewareRoute) {
            $index++;
            $middlewares->add($index, $middlewareRoute);
        }
    }

}
