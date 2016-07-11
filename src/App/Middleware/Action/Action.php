<?php
namespace App\Middleware\Action;

use DMS\TornadoHttp\Middleware\Middleware;
use DMS\TornadoHttp\Container\ContainerTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Parent class for the Actions of the Middlewares of Routes
 *
 * @package App\Middleware
 */
abstract class Action extends Middleware implements ActionInterface
{
    use ContainerTrait;

    /**
     * Invocation
     *
     * @param RequestInterface $request Request
     * @param ResponseInterface $response Response
     * @param callable $next Next Middleware
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        $response = $this->run($request, $response);

        return $next($request, $response);
    }
}
