<?php 

namespace Tests;

use App\Services\Parser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

class ParserTest extends TestCase
{
    protected $outputFilePath;
    protected $testFilePath;
    protected $testOutputFilePath;

    protected function setUp(): void
    {
        $this->outputFilePath = dirname(__FILE__, 2) . '/output/access.csv';
        $this->testFilePath = __DIR__ . '/Files/small.access.log';
        $this->testOutputFilePath = __DIR__ . '/Files/small.access.csv';
        (new Filesystem())->remove($this->outputFilePath);
    }

    /** @test */
    public function it_outputs_data()
    {
        //when creating parser with file that doesnt exist
        $parser = new Parser($this->testFilePath);
        $parser->buildCsv();

        //expect file contents of test file to match example output file contents
        $expected = file_get_contents($this->testOutputFilePath);
        $result = file_get_contents($this->outputFilePath);
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function it_builds_csv()
    {
        //when creating a parser with an nginx access.log file
        $parser = new Parser($this->testFilePath);
        $parser->buildCsv();

        //expect access.csv file at /app/output/access.csv
        $this->assertFileExists($this->outputFilePath);
    }

    protected function tearDown(): void
    {
        (new Filesystem())->remove($this->outputFilePath);
    }
}
