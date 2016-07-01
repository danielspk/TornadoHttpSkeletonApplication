<?php
namespace App\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\QueryException;

/**
 * Service for generate route path
 *
 * @package App\Service
 */
class RouteGenerator
{
    /**
     * @var array
     */
    private $routes;

    /**
     * Constructor
     *
     * @param array $routes Routes definition
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Method that create path route
     *
     * @param string $name Route name
     * @param array  $parameters Route parameters
     * @return string
     */
    public function create($name, array $parameters = [])
    {
        if (!array_key_exists($name, $this->routes)) {
            return 'not_exists';
        }

        $path = $this->routes[$name]['path'];
        $path = str_replace(['[', ']'], '', $path);
        $path = preg_replace('/(\\:[a-zA-Z0-9 \\\\ \\|]*[a-zA-Z0-9 \\+])/', '', $path); // remove regex

        foreach ($parameters as $key => $value) {
            $path = str_replace('{'.$key.'}', $value, $path);
        }

        $path = preg_replace('/(\\{[a-zA-Z0-9]*\\})/', '', $path); // remove optionals

        return rtrim($path, '/');
    }
}
