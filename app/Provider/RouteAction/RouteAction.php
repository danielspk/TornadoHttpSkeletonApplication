<?php
namespace App\Provider\RouteAction;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Provider\Helper\Config;
use League\Container\Container;
use League\Plates\Engine;

abstract class RouteAction implements RouteActionInterface {

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Engine
     */
    protected $view;

    /**
     * @param RequestInterface $pRequest
     * @param ResponseInterface $pResponse
     * @param callable $pNext
     * @return mixed
     */
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext)
    {
        /** @var \DMS\TornadoHttp\TornadoHttp $pNext */
        $this->config = $pNext->getConfig();
        $this->container = $pNext->getDI();
        $this->view = $this->container->get('plates');

        $response = $this->run($pRequest, $pResponse);

        return $pNext($pRequest, $response);
    }
}