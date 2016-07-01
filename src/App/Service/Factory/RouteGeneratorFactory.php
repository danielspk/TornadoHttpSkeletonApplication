<?php
namespace App\Service\Factory;

use App\Service\RouteGenerator;

/**
 * Factory of Route Generator
 *
 * @package App\Service
 */
class RouteGeneratorFactory
{
    /**
     * Invocation
     *
     * @return RouteGenerator
     */
    public function __invoke()
    {
        return new RouteGenerator(require __DIR__.'/../../routes.php');
    }
}
