<?php

namespace App\Services;

use Symfony\Component\Filesystem\Filesystem;
use Kassner\LogParser\LogParser;
use App\Services\GeoIp2;
use App\Services\UserAgentParser;

class Parser
{
    private $logParser;
    private $userAgentParser;
    private $file;
    private $fileSystem;
    private $geoIp2;

    public function __construct($file)
    {
        $this->file = $file;
        $this->fileSystem = new Filesystem();
        $this->geoIp2 = new GeoIp2();
        $this->userAgentParser = new UserAgentParser();
        $this->logParser = new LogParser();
        $this->logParser->setFormat('%h %l %u %t "%r" %>s %O "%{Referer}i" \"%{User-Agent}i"');
    }

    public function parse()
    {
        if(!$this->fileSystem->exists($this->file)) {
            throw new \Exception($this->file . ' does not exist');
        }
        $lines = file($this->file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $entry = $this->logParser->parse($line);
            list($country, $state) = $this->geoIp2->getGeo($entry->host);
            list($browser, $device) = $this->userAgentParser->parse($entry->HeaderUserAgent);
            die();
        }
    }
}
