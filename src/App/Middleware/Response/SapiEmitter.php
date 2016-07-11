<?php
namespace App\Middleware\Response;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\SapiEmitter;

/**
 * Middleware that emit the response of request
 *
 * @package App\Middleware
 */
class SapiEmitter
{
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
        $response = $next($request, $response);

        $emitter = new SapiEmitter();
        $emitter->emit($response);

        return $response;
    }
}
