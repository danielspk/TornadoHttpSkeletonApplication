<?php

namespace App\Console\Command;

use Interop\Container\ContainerInterface;
use Nelmio\Alice\Fixtures;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class FixtureCommand
 *
 * @package App\Console\Command
 */
class FixtureCommand extends Command
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Constructor
     *
     * @param ContainerInterface $container Container DI
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct();

        $this->container = $container;
    }

    /**
     * Configure command
     */
    protected function configure()
    {
        $this->setName('fixtures:run')
            ->setDescription('Run fixtures.');
    }

    /**
     * Execute command
     *
     * @param InputInterface $input Input console
     * @param OutputInterface $output Output console
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entityManager = $this->container->get('EntityManager');

        Fixtures::load('src/App/Fixtures/fixtures.yml', $entityManager);

        $output->writeln('<info>Finished</info>');
    }
}
