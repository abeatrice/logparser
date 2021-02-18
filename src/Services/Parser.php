<?php

namespace App\Services;

use Symfony\Component\Filesystem\Filesystem;
use Kassner\LogParser\LogParser;

class Parser
{
    private $logParser;
    private $file;
    private $fileSystem;

    public function __construct($file)
    {
        $this->file = $file;
        $this->fileSystem = new Filesystem();
        $this->logParser = new LogParser();
        $this->logParser->setFormat('%h %l %u %t "%r" %>s %O "%{Referer}i" \"%{User-Agent}i"');
    }

    public function execute()
    {
        if(!$this->fileSystem->exists($this->file)) {
            throw new \Exception($this->file . ' does not exist');
        }
        $lines = file($this->file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            try {
                $entry = $this->logParser->parse($line);
                var_dump($entry);
            } catch (\Throwable $th) {
                var_dump($th->getMessage());
            }
            die();
        }
    }
}
