<?php
namespace App\Modules\Application\RouteAction;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Provider\RouteAction\RouteAction;

/**
 * Class de Ejemplo de Acción
 *
 * @package App\Modules\Application\RouteAction
 */
class IndexAction extends RouteAction {

    /**
     * Método con lógica de la acción
     *
     * @param RequestInterface $pRequest Petición
     * @param ResponseInterface $pResponse Respuesta
     * @return ResponseInterface
     */
    public function run(RequestInterface $pRequest, ResponseInterface $pResponse)
    {
        $pResponse->getBody()->write(' Index Action ');
        $pResponse->getBody()->write($this->view->render('app::example', ['hello' => 'Hello Template']));
        return $pResponse;
    }

}