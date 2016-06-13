<?php

namespace App\Console\Command;

use Interop\Container\ContainerInterface;
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
     * Constructor
     *
     * @param ContainerInterface $container Container DI
     */
    public function __construct(ContainerInterface $container) {
        parent::__construct();
    }

    /**
     * Configure command
     */
    protected function configure() {
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
    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->write('Finish!!!'.PHP_EOL);
    }
}
