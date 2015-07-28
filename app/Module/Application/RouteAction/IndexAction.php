<?php
namespace App\Module\Application\RouteAction;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Provider\Core\RouteAction;

/**
 * Class de Ejemplo de Acción
 *
 * @package App\Module\Application\RouteAction
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
        /** @var \DateTime $date */
        $date = $this->container->get('datetime');

        $pResponse->getBody()->write(' Index Action ' . $date->format('d/m/Y'));
        $pResponse->getBody()->write($this->view->render('app::example', ['hello' => 'Hello Template']));
        return $pResponse;
    }

}
