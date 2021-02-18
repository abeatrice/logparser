<?php

namespace App\Command;

use App\Services\Parser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Kassner\LogParser\LogParser;

/**
 * Class ParseCommand
 */
class ParseCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'parse';

    protected function configure()
    {
        $this->setDescription('parse log files for geo location data and export csv')
            ->addArgument('file', InputArgument::REQUIRED, 'Input access log file path');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');
        $parser = new Parser($file);
        $parser->parse();
        $output->writeln('done');
    }
}
