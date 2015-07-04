<?php
namespace App\Modules\Core\RouteAction;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface RouteActionInterface {
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext);
    public function run();
}