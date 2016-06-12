<?php

namespace App\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FixtureCommand extends Command
{
    protected function configure() {
        $this->setName('fixtures:run')
            ->setDescription('Run fixtures.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->write('Finish!!!'.PHP_EOL);
    }
}
