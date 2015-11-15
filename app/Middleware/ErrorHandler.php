<?php
namespace App\Middleware;

use App\Provider\Exception\HttpMethodNotAllowedException;
use App\Provider\Exception\HttpNotFoundException;
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
        try {

            $response = $pNext($pRequest, $pResponse);

        } catch (HttpNotFoundException $e) {

            $response = new Response();
            $response = $response->withStatus(404);
            $response->getBody()->write('Página no encontrada');

        } catch (HttpMethodNotAllowedException $e) {

            $response = new Response();
            $response = $response->withStatus(405);
            $response->getBody()->write('Método no soportado');

        } catch (\Exception $e) {

            $response = new Response();
            $response = $response->withStatus(500);
            $response->getBody()->write('Fatal Error: ' . $e->getMessage() . ', ' . $e->getFile());

        }

        return $response;
    }

}
