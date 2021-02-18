<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ParseCommand
 */
class ParseCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:parse';

    protected function configure()
    {
        $this->setDescription('parse log files for geo location data and export csv');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('This command does nothing');
    }
}
