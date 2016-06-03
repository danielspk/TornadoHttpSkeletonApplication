<?php
namespace App\Middleware\Route;

use DMS\TornadoHttp\ContainerTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Parent class for the Actions of the Middlewares of Routes
 *
 * @package App\Middleware
 */
abstract class Action implements ActionInterface
{
    use ContainerTrait;

    /**
     * Invocation
     *
     * @param ServerRequestInterface $request Request
     * @param ResponseInterface $response Response
     * @param callable $next Next Middleware
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $response = $this->run($request, $response);

        return $next($request, $response);
    }
}
