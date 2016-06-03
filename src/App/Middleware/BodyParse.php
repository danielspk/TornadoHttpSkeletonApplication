<?php
namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Middleware that parse the body according to the type of content type
 *
 * @package App\Middleware
 */
class BodyParse
{
    /**
     * @var array Content-Type for Json
     */
    protected $contentTypeJson = [
        'application/json',
        'application/javascript'
    ];

    /**
     * @var array Content-Type for String
     */
    protected $contentTypeString = [
        'multipart/form-data',
        'application/x-www-form-urlencoded'
    ];

    /**
     * @var array Content-Type for Xml
     */
    protected $contentTypeXml = [
        'text/xml',
        'application/xml'
    ];

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
        $method      = $request->getMethod();
        $body        = $request->getParsedBody();
        $contentType = $request->getHeader('Content-type');

        if ($method != 'GET' && !$body && count($contentType) == 1) {
            $data = [];
            $body = file_get_contents('php://input');

            if (in_array($contentType[0], $this->contentTypeString)) {
                parse_str($body, $data);
            } elseif (in_array($contentType[0], $this->contentTypeJson)) {
                $data = json_decode($body);
            } elseif (in_array($contentType[0], $this->contentTypeXml)) {
                $data = simplexml_load_string($body);
            }

            $request = $request->withParsedBody($data);
        }
        
        return $next($request, $response);
    }
}
