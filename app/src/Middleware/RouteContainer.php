<?php
namespace App\Middleware;

use DMS\TornadoHttp\TornadoHttp;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use FastRoute;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

class RouteContainer {

    /**
     * @var array Archivos de rutas
     */
    private $files;

    /**
     * Constructor
     *
     * @param array $pFiles Archivos de rutas
     */
    public function __construct(array $pFiles)
    {
        $this->files = $pFiles;
    }

    /**
     * Invocación de registración de contenedor de rutas
     *
     * @param RequestInterface $pRequest Petición
     * @param ResponseInterface $pResponse Respuesta
     * @param callable $pNext Próximo Middleware
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext)
    {
        $dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {

            foreach ($this->files as $file) {

                if (file_exists($file)) {

                    $routes = require $file;

                    foreach($routes as $route) {
                        $r->addRoute($route[0], $route[1], $route[2]);
                    }

                }

            }

        });

        // se elimina el document root del path del request para que coincida con la ruta
        /** @var \DMS\TornadoHttp\TornadoHttp $pNext */
        $uri = '/' . str_replace($pNext->getConfig()['document.root'], '', $pRequest->getUri()->getPath());
        $route = $dispatcher->dispatch($pRequest->getMethod(), $uri);

        switch ($route[0]) {
            case Dispatcher::NOT_FOUND:
                return $pResponse->withStatus(404); //crear error
            case Dispatcher::METHOD_NOT_ALLOWED:
                return $pResponse->withStatus(405); // crear error
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
     * Registra los middlewares de la ruta mapeada detras del indice actual de la cola de ejecución
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