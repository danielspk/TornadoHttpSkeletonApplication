<?php
namespace App\Module\Application\Action;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Middleware\ADR\MiddlewareAction;

/**
 * Clase de Ejemplo de Action de Ruta
 *
 * @package App\Module\Application\Action
 */
class IndexAction extends MiddlewareAction
{

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

        $pResponse->getBody()->write('Inside Route Action 1 process - date:' . $date->format('d/m/Y') . '<br />');

        $view = $this->container->get('ViewModel')
            ->setTemplate('example.php')
            ->setVariables([
                'hello' => 'Hello Template ViewModel'
            ]);

        $pResponse->getBody()->write($this->view->render($view));

        return $pResponse;
    }

}
