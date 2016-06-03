<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Dotenv\Dotenv;

/**
 * Doctrine console
 */
$dotenv = new Dotenv('src/App');
$dotenv->load();

$config = require 'src/App/config.php';

$isDevMode = ($config['environment'] == 'develop');
$setup = Setup::createAnnotationMetadataConfiguration($config['doctrine.orm']['entities.src'], $isDevMode);
$entityManager = EntityManager::create($config['doctrine.orm']['db.params'], $setup);

return ConsoleRunner::createHelperSet($entityManager);
