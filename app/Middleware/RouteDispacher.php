<?php
namespace App\Middleware;

use App\Provider\Exception\HttpMethodNotAllowedException;
use App\Provider\Exception\HttpNotFoundException;
use DMS\TornadoHttp\TornadoHttp;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use FastRoute;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

/**
 * Clase Action que registra las rutas en su contenedor y despacha la petición a una ruta
 *
 * @package App\Action
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
     * @param callable $pNext Próximo Action
     * @return ResponseInterface
     * @throws HttpMethodNotAllowedException
     * @throws HttpNotFoundException
     */
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext)
    {
        /** @var \DMS\TornadoHttp\TornadoHttp $pNext */
        /** @var \Interop\Container\ContainerInterface $container */
        /** @var \Zend\Config\Config $config */

        $dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {

            foreach($this->routes as $route) {
                $r->addRoute($route[0], $route[1], $route[2]);
            }

        });

        // se elimina el document root del path del request para que coincida con la ruta
        $container = $pNext->getDI();
        $config = $container->get('Config');
        $uri = '/' . str_ireplace($config['document.root'], '', $pRequest->getUri()->getPath());
        $route = $dispatcher->dispatch($pRequest->getMethod(), $uri);

        switch ($route[0]) {
            case Dispatcher::NOT_FOUND:
                throw new HttpNotFoundException();
            case Dispatcher::METHOD_NOT_ALLOWED:
                throw new HttpMethodNotAllowedException();
            case Dispatcher::FOUND:
                $handlers = $route[1];
                $vars = $route[2];
                break;
        }

        foreach ($vars as $name => $value) {
            $pRequest = $pRequest->withAttribute($name, $value);
        }

        $this->registerMiddlewareRoute($pNext, $handlers);

        return $pNext($pRequest, $pResponse);
    }

    /**
     * Método que registra los middlewares de la ruta despachada detras del indice actual de la cola de ejecución
     *
     * @param TornadoHttp $pApp
     * @param array $pHandlers
     */
    public function registerMiddlewareRoute($pApp, $pHandlers)
    {
        $middlewares = $pApp->getMiddlewares();
        $index = $middlewares->key();

        foreach ($pHandlers as $middlewareRoute) {
            $index++;
            if ($middlewares->offsetExists($index)) {
                $middlewares->add($index, $middlewareRoute);
            } else {
                $middlewares->enqueue($middlewareRoute);
            }
        }
    }

}
