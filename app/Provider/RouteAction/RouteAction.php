<?php
namespace App\Provider\RouteAction;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use League\Container\Container;
use League\Plates\Engine;

/**
 * Clase padre para las Acciones de los Middlewares de Rutas
 *
 * @package App\Provider\RouteAction
 */
abstract class RouteAction implements RouteActionInterface {

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Engine
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
        $this->view = $this->container->get('plates');

        $response = $this->run($pRequest, $pResponse);

        return $pNext($pRequest, $response);
    }
}