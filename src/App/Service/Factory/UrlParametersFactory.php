<?php
namespace App\Service\Factory;

use App\Service\UrlParameters;
use Interop\Container\ContainerInterface;

/**
 * Factory of Service that parse url parameters
 *
 * @package App\Service
 */
class UrlParametersFactory
{
    /**
     * Invocation
     *
     * @param ContainerInterface $container Dependency Injection
     * @return UrlParameters
     */
    public function __invoke(ContainerInterface $container)
    {
        $entityManager = $container->get('EntityManager');
        
        return new UrlParameters($entityManager);
    }
}
