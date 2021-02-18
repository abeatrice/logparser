<?php

namespace App\Services;

use Symfony\Component\Filesystem\Filesystem;

class Parser
{
    private $file;
    private $fileSystem;

    public function __construct($file)
    {
        $this->file = $file;
        $this->fileSystem = new Filesystem();
    }

    public function execute()
    {
        if(!$this->fileSystem->exists($this->file)) {
            throw new \Exception($this->file . ' does not exist');
        }
    }
}
