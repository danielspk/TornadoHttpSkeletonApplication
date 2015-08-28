<?php
namespace App\Provider\MiddlewareRoute;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Interop\Container\ContainerInterface;
use Zend\View\Renderer\PhpRenderer;

/**
 * Clase padre para las Acciones de los Middlewares de Rutas
 *
 * @package App\Provider\MiddlewareRoute
 */
abstract class MiddlewareRoute implements MiddlewareRouteInterface {

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var PhpRenderer
     */
    protected $view;

    /**
     * Método invocable por la ruta despachada
     *
     * @param RequestInterface $pRequest Petición
     * @param ResponseInterface $pResponse Respuesta
     * @param callable $pNext Próximo Middleware
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext)
    {
        /** @var \DMS\TornadoHttp\TornadoHttp $pNext */
        $this->container = $pNext->getDI();
        $this->view = $this->container->get('Renderer');

        $response = $this->run($pRequest, $pResponse);

        return $pNext($pRequest, $response);
    }
}
