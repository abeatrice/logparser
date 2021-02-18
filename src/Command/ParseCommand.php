<?php

namespace App\Command;

use App\Services\Parser;
use Carbon\Carbon;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
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
    protected static $defaultName = 'parse';

    protected function configure()
    {
        $this->setDescription('parse nginx access log files for geo location data and export csv')
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
        $start = Carbon::now();
        
        $file = $input->getArgument('file');
        $output->writeln("[{$start->toDateTimeString()}] parsing file: {$file}");
        
        $parser = new Parser($file);
        $parser->buildCsv();
        
        $end = Carbon::now();
        $timeElapsed = $start->diffInSeconds($end);
        $output->writeln("[{$end->toDateTimeString()}] {$file} parsed and csv built in {$timeElapsed} second(s).");
    }
}
