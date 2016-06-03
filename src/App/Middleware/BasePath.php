<?php
namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Middleware that adjust the path of the request based on root of the project
 *
 * @package App\Middleware
 */
class BasePath
{
    /**
     * @var string Root path
     */
    private $basePath;
    
    /**
     * Constructor
     *
     * @param string $basePath Root path of project
     */
    public function __construct($basePath = '/')
    {
        $this->basePath = $basePath;
    }
    
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
        if ($this->basePath !== '/') {

            $uri = $request->getUri();
            $path = '/'.preg_replace(
                '/^'.str_replace(
                    '/',
                    '\/',
                    $this->basePath
                ).'/',
                '',
                $request->getUri()->getPath()
            );
            $request = $request->withUri($uri->withPath($path));
        
        }
        
        return $next($request, $response);
    }
}
