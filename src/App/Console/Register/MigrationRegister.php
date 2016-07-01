<?php

namespace App\Console\Register;

use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Application;

/**
 * Class MigrationRegister
 *
 * @package App\Console\Register
 */
class MigrationRegister
{
    /**
     * Constructor
     *
     * @param Application $console Console
     * @param ContainerInterface $container Container DI
     */
    public function __construct(Application $console, ContainerInterface $container)
    {
        $config = $container->get('Config');
        $entityManager = $container->get('EntityManager');

        $migrationConfiguration = new Configuration($entityManager->getConnection());
        $migrationConfiguration->setMigrationsTableName($config->{'doctrine.orm'}->migrations->table);
        $migrationConfiguration->setMigrationsNamespace($config->{'doctrine.orm'}->migrations->namespace);
        $migrationConfiguration->setMigrationsDirectory($config->{'doctrine.orm'}->migrations->directory);
        $migrationConfiguration->registerMigrationsFromDirectory($config->{'doctrine.orm'}->migrations->directory);
        
        $migrationCommands = [
            'DiffCommand',
            'ExecuteCommand',
            'GenerateCommand',
            'MigrateCommand',
            'StatusCommand',
            'VersionCommand',
        ];

        foreach ($migrationCommands as $commandName) {
            /** @var \Doctrine\DBAL\Migrations\Tools\Console\Command\AbstractCommand $command */

            $fullCommandName = 'Doctrine\\DBAL\\Migrations\\Tools\\Console\\Command\\'.$commandName;
            $command = new $fullCommandName();
            $command->setMigrationConfiguration($migrationConfiguration);

            $console->add($command);
        }
    }
}
