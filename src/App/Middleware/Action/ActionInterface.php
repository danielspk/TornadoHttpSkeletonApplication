<?php
namespace App\Middleware\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Interface for the Actions of the Middlewares of Routes
 *
 * @package App\Middleware
 */
interface ActionInterface
{
    /**
     * Method that executes the logic of the action of the route dispatched
     *
     * @param RequestInterface $request Request
     * @param ResponseInterface $response Response
     * @return ResponseInterface
     */
    public function run(RequestInterface $request, ResponseInterface $response);
}
