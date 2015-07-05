<?php
namespace App\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;

class ErrorHandler {

    /**
     * Invocación de petición/respuesta de inicio de aplicación
     *
     * @param RequestInterface $pRequest Peticion
     * @param ResponseInterface $pResponse Respuesta
     * @param callable $pNext Próximo Middleware
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext)
    {
        /** @var \DMS\TornadoHttp\TornadoHttp $pNext */

        try{

            $response = $pNext($pRequest, $pResponse);

        } catch (\Exception $e) {

            $exception = $pNext->getExceptionHandler();

            // se determina si el usuario registro un middleware de errores personalizado ...
            if ($exception) {

                $handler = $pNext->resolveCallable($exception);
                $response = $exception($pRequest, $pResponse, $pNext, $e);

            } else {

                $response = new Response();
                $response = $response->withStatus(500);
                $response->getBody()->write('Default Error: ' . $e->getMessage());

            }

            $emitter = new SapiEmitter();
            $emitter->emit($response);
            exit();

        }

        return $response;
    }

}