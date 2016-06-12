<?php

use Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Dotenv\Dotenv;
use Symfony\Component\Console\Helper\QuestionHelper;

/**
 * Doctrine console
 */
$dotenv = new Dotenv('src/App');
$dotenv->load();

$config = require 'src/App/config.php';

$isDevMode = ($config['environment'] == 'develop');
$setup = Setup::createAnnotationMetadataConfiguration($config['doctrine.orm']['entities.src'], $isDevMode);
$entityManager = EntityManager::create($config['doctrine.orm']['db.params'], $setup);

$helperSet = ConsoleRunner::createHelperSet($entityManager);
$helperSet->set(new QuestionHelper(), 'dialog');

$cli = ConsoleRunner::createApplication($helperSet, [
    new DiffCommand(),
    new ExecuteCommand(),
    new GenerateCommand(),
    new MigrateCommand(),
    new StatusCommand(),
    new VersionCommand(),
]);

return $cli->run();
