<?php
namespace App\Modules\Application\RouteAction;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Provider\RouteAction\RouteAction;

class IndexAction extends RouteAction {

    public function run(RequestInterface $pRequest, ResponseInterface $pResponse)
    {
        $pResponse->getBody()->write(' Index Action ');
        $pResponse->getBody()->write($this->view->render('app::example', ['hello' => 'Hello Template']));
        return $pResponse;
    }

}