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
        $entityManager = $container->get('EntityManager');

        $migrationConfiguration = new Configuration($entityManager->getConnection());
        $migrationConfiguration->setMigrationsTableName('doctrine_migration_versions');
        $migrationConfiguration->setMigrationsNamespace('App\\Migrations');
        $migrationConfiguration->setMigrationsDirectory('src/App/Migrations');
        $migrationConfiguration->registerMigrationsFromDirectory('src/App/Migrations');
        
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
