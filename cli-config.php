<?php

use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Dotenv\Dotenv;
use Symfony\Component\Console\Helper\QuestionHelper;

/**
 * Doctrine console configuration
 */

// config by environment
$dotenv = new Dotenv('src/App');
$dotenv->load();

$config = require 'src/App/config.php';

// config entityManager
$isDevMode = ($config['environment'] == 'develop');
$emSetup = Setup::createAnnotationMetadataConfiguration($config['doctrine.orm']['entities.src'], $isDevMode);
$entityManager = EntityManager::create($config['doctrine.orm']['db.params'], $emSetup);

// create helperSet
$helperSet = ConsoleRunner::createHelperSet($entityManager);
$helperSet->set(new QuestionHelper(), 'dialog');

// create console application
$cli = ConsoleRunner::createApplication($helperSet);

// config migration commands
$migrationConfiguration = new Configuration($entityManager->getConnection());
$migrationConfiguration->setMigrationsTableName('doctrine_migration_versions');
$migrationConfiguration->setMigrationsNamespace('App\\Migrations');
$migrationConfiguration->setMigrationsDirectory(__DIR__.'/src/App/Migrations');
$migrationConfiguration->registerMigrationsFromDirectory(__DIR__.'/src/App/Migrations');

// add migration commands to console application
$migrationCommands = [
    'DiffCommand',
    'ExecuteCommand',
    'GenerateCommand',
    'MigrateCommand',
    'StatusCommand',
    'VersionCommand',
];

foreach($migrationCommands as $commandName) {
    $fullCommandName = 'Doctrine\\DBAL\\Migrations\\Tools\\Console\\Command\\'.$commandName;
    $command = new $fullCommandName();
    $command->setMigrationConfiguration($migrationConfiguration);

    $cli->add($command);
}

// run console
return $cli->run();
