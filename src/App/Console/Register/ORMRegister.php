<?php

namespace App\Console\Register;

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\QuestionHelper;

/**
 * Class ORMRegister
 *
 * @package App\Console\Register
 */
class ORMRegister
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

        $helperSet = ConsoleRunner::createHelperSet($entityManager);
        $helperSet->set(new QuestionHelper(), 'dialog');

        $console->setHelperSet($helperSet);

        ConsoleRunner::addCommands($console);
    }
}
