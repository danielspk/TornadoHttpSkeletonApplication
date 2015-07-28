<?php
namespace App\Module\Application\ActionRoute;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Provider\Core\ActionRoute;

/**
 * Class de Ejemplo de Acción
 *
 * @package App\Module\Application\ActionRoute
 */
class IndexAction extends ActionRoute {

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
        $date = $this->container->get('DateTime');

        $pResponse->getBody()->write('Action Middleware 1 process - date:' . $date->format('d/m/Y') . '<br />');

        $view = $this->container->get('ViewModel')
            ->setTemplate('example.php')
            ->setVariables([
                'hello' => 'Hello Template ViewModel'
            ]);

        $pResponse->getBody()->write($this->view->render($view));

        return $pResponse;
    }

}
