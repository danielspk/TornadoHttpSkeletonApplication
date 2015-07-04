<?php
namespace App\Modules\Application\RouteAction;

use App\Modules\Core\RouteAction\RouteAction;

class IndexAction extends RouteAction {

    public function run()
    {
        /** @var \League\Plates\Engine $plates */
        $plates = $this->app->getDI()['plates'];
        $plates->addFolder('index', __DIR__ . '/../views');

        $this->response->getBody()->write(' Index Action ');
        $this->response->getBody()->write($plates->render('index::example', ['hello' => 'Hello Template']));
    }

}