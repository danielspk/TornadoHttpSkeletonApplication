<?php
namespace App\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\SapiEmitter;

/**
 * Clase Middleware que emite la respuesta de la petición
 *
 * @package App\Middleware
 */
class ResponseEmitter {

    /**
     * Invocación de emisión de respuesta
     *
     * @param RequestInterface $pRequest Peticion
     * @param ResponseInterface $pResponse Respuesta
     * @param callable $pNext Próximo Middleware
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext)
    {
        $response = $pNext($pRequest, $pResponse);

        $emitter = new SapiEmitter();
        $emitter->emit($response);

        return $response;
    }

}