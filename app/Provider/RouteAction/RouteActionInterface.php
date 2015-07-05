<?php
namespace App\Provider\RouteAction;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface para las Acciones de los Middlewares de Rutas
 *
 * @package App\Provider\RouteAction
 */
interface RouteActionInterface {
    /**
     * Método invocable por la ruta despachada
     *
     * @param RequestInterface $pRequest Petición
     * @param ResponseInterface $pResponse Respuesta
     * @param callable $pNext Próximo Middleware
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext);

    /**
     * Método que ejecuta la lógica de la acción de la ruta despachada
     *
     * @param RequestInterface $pRequest Petición
     * @param ResponseInterface $pResponse Respuesta
     * @return ResponseInterface
     */
    public function run(RequestInterface $pRequest, ResponseInterface $pResponse);
}