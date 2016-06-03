<?php
namespace App\Service\Factory;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Interop\Container\ContainerInterface;

/**
 * Factory of Service that create an Entity Manager by Doctrine
 *
 * @package App\Service
 */
class EntityManagerFactory
{
    /**
     * Invocation
     *
     * @param ContainerInterface $container Dependency Injection
     * @return EntityManager
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var \Zend\Config\Config $config */

        $config = $container->get('Config');
        
        $isDevMode = ($config->environment == 'develop');
        $paths     = $config->{'doctrine.orm'}->{'entities.src'}->toArray();
        $dbParams  = $config->{'doctrine.orm'}->{'db.params'}->toArray();
        
        $setup = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $entityManager = EntityManager::create($dbParams, $setup);
        $entityManagerConfig = $entityManager->getConfiguration();
        
        foreach ($config->{'doctrine.orm'}->{'entities.alias'} as $alias => $namespace) {
            $entityManagerConfig->addEntityNamespace($alias, $namespace);
        }
        
        return $entityManager;
    }
}
