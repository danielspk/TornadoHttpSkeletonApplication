<?php
namespace App\Middleware;

use App\Exception\AuthException;
use App\Exception\HttpMethodNotAllowedException;
use App\Exception\HttpNotFoundException;
use DMS\TornadoHttp\Container\ContainerTrait;
use Doctrine\ORM\Query\QueryException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Middleware that manages the application exceptions
 *
 * @package App\Middleware
 */
class ErrorHandler
{
    use ContainerTrait;
    
    /**
     * @var array Value of header Accept
     */
    private $accept;

    /**
     * @var array Debug environments
     */
    private $debugModes = ['local', 'development'];

    /**
     * @var boolean Indicate if the application are in debug mode
     */
    private $debug;
    
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
        $this->accept = $request->getHeader('Accept');
        $this->debug  = in_array($this->container->get('Config')->environment, $this->debugModes);
        
        try {
            $response = $next($request, $response);
        } catch (HttpNotFoundException $e) {
            $response = $this->getResponseFormat('Resource not found', 404, $e);
        } catch (HttpMethodNotAllowedException $e) {
            $response = $this->getResponseFormat('Method not allowed', 405, $e);
        } catch (AuthException $e) {
            $response = $this->getResponseFormat('Access denied', 401, $e);
        } catch (QueryException $e) {
            $response = $this->getResponseFormat('Search criteria malformed', 400, $e);
        } catch (\Exception $e) {
            $response = $this->getResponseFormat('Fatal Error', 500, $e);
        }

        return $response;
    }

    /**
     * Method that returns a response in the request format
     *
     * @todo Customize according to project
     * @param string $message Error message
     * @param int $status Status code
     * @param \Exception $exception Exception caught
     * @return JsonResponse|HtmlResponse
     */
    public function getResponseFormat($message, $status, \Exception $exception)
    {
        if (count($this->accept) > 0 && $this->accept[0] == 'application/json') {
            $data = [
                'status' => $status,
                'error' => [
                    'msg' => $message
                ]
            ];
            
            if ($this->debug) {
                $data['error']['debug']['msg'] = $exception->getMessage();
                $data['error']['debug']['file'] = $exception->getFile();
                $data['error']['debug']['line'] = $exception->getLine();
                $data['error']['debug']['trace'] = $exception->getTrace();
            }

            return new JsonResponse($data, $status);
        }

        $msg = $message;
        
        if ($this->debug) {
            $msg .= '<br />Description: '.$exception->getMessage();
            $msg .= '<br />File: '.$exception->getFile();
            $msg .= '<br />Line: '.$exception->getLine();
            $msg .= '<br />Trace: '.$exception->getTraceAsString();
        }
        
        return new HtmlResponse($msg, $status);
    }
}
