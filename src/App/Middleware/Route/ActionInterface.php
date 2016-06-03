<?php
namespace App\Middleware\Route;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface for the Actions of the Middlewares of Routes
 *
 * @package App\Middleware
 */
interface ActionInterface
{
    /**
     * Invocation
     *
     * @param ServerRequestInterface $request Request
     * @param ResponseInterface $response Response
     * @param callable $next Next Middleware
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next);

    /**
     * Method that executes the logic of the action of the route dispatched
     *
     * @param ServerRequestInterface $request Request
     * @param ResponseInterface $response Response
     * @return ResponseInterface
     */
    public function run(ServerRequestInterface $request, ResponseInterface $response);
}
