<?php
namespace App\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

/**
 * Clase Middleware que gestiona las excepciones de la Aplicación
 *
 * @package App\Middleware
 */
class ErrorHandler {

    /**
     * Invocación de gestión de excepciones
     *
     * @param RequestInterface $pRequest Peticion
     * @param ResponseInterface $pResponse Respuesta
     * @param callable $pNext Próximo Middleware
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext)
    {
        try{

            $response = $pNext($pRequest, $pResponse);

        } catch (\Exception $e) {

            $response = new Response();
            $response = $response->withStatus(500);
            $response->getBody()->write('Personal Error: ' . $e->getMessage() . ', ' . $e->getFile());

        }

        return $response;
    }

}