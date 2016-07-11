<?php
namespace App\Middleware\Auth;

use App\Exception\AuthException;
use DMS\TornadoHttp\Container\ContainerTrait;
use Firebase\JWT\JWT as JWTLib;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Middleware that validates Jwt Authentication
 *
 * @package App\Middleware
 */
class Jwt
{
    use ContainerTrait;
    
    /**
     * Invocation
     *
     * @todo Not tested
     * @param ServerRequestInterface $request Request
     * @param ResponseInterface $response Response
     * @param callable $next Next Middleware
     * @return ResponseInterface
     * @throws AuthException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $authHeader = $request->getHeader('authorization');
        
        if ($authHeader) {

            list($jwt) = sscanf($authHeader, 'Bearer %s');

            if ($jwt) {

                $config = $this->container->get('Config')->jwt;
                $secret = base64_decode($config->secret);
                
                try {
                    $token = JWTLib::decode($jwt, $secret, array('HS512'));
                    $request = $request->withAttribute('JWT', $token);
                } catch (\Exception $e) {
                    throw new AuthException($e);
                }

            } else {
                throw new AuthException('Invalid format of credentials');
            }
        } else {
            throw new AuthException('Credentials were not provided');
        }
        
        return $next($request, $response);
    }
}
