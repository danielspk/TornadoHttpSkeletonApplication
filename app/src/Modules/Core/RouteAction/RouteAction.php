<?php
namespace App\Modules\Core\RouteAction;

use DMS\TornadoHttp\TornadoHttp;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class RouteAction implements RouteActionInterface {

    /**
     * @var TornadoHttp
     */
    protected $app;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @param RequestInterface $pRequest
     * @param ResponseInterface $pResponse
     * @param callable $pNext
     * @return mixed
     */
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext)
    {
        /** @var \DMS\TornadoHttp\TornadoHttp $pNext */
        $this->app = $pNext;
        $this->request = $pRequest;
        $this->response = $pResponse;

        $this->run();

        return $pNext($this->request, $this->response);
    }
}