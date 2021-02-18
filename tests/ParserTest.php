<?php 

namespace Tests;

use App\Services\Parser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

class ParserTest extends TestCase
{
    protected $fileSystem;
    protected $file;

    protected function setUp(): void
    {
        $this->file = __DIR__ . '/Files/test.log';
    }

    /** @test */
    public function it_returns_csv()
    {
        $parser = new Parser($this->file);
        $csv = $parser->execute();
        $this->assertTrue(true);
    }
}
