<?php
namespace App\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

/**
 * Clase Action que gestiona las excepciones de la Aplicación
 *
 * @package App\Action
 */
class ErrorHandler {

    /**
     * Invocación de gestión de excepciones
     *
     * @param RequestInterface $pRequest Peticion
     * @param ResponseInterface $pResponse Respuesta
     * @param callable $pNext Próximo Action
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext)
    {
        try{

            $response = $pNext($pRequest, $pResponse);

        } catch (\Exception $e) {

            // Mejoras posibles: Según tipo de Excepción devolver distintos códigos de status
            
            $response = new Response();
            $response = $response->withStatus(500);
            $response->getBody()->write('Personal Error: ' . $e->getMessage() . ', ' . $e->getFile());

        }

        return $response;
    }

}
