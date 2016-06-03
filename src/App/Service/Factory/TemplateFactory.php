<?php
namespace App\Service\Factory;

use Interop\Container\ContainerInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Factory of Service for views templates
 *
 * @package App\Service
 */
class TemplateFactory
{
    /**
     * Invocation
     *
     * @param ContainerInterface $container Dependency Injection
     * @return Twig_Environment
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var \Zend\Config\Config $config */

        $config = $container->get('Config');
        
        $twigLoader = new Twig_Loader_Filesystem($config->templates->dir->toArray());
        
        return new Twig_Environment($twigLoader, [
            'auto_reload' => ($config->environment != 'production'),
            'cache'       => $config->templates->cache
        ]);
    }
}
