<?php
/**
 * Unit test for turnover reports
 * ------------------------------
 *
 * Developed by Dananjaya M. Perera (dananjjaya01@gmail.com)
 * 
 */


require_once "config.php";
require_once "otrium/db.php";
require_once "otrium/reports/reports.php";

class TurnoverTest extends \PHPUnit\Framework\TestCase
{
    public function testTurnoverPerBrand(){
        // Make a instance
        $TurnoverPerBrand = new \otrium\reports\TurnoverPerBrand();

        // Generate the report but ignore download
        $file = $TurnoverPerBrand->generate(false);
    
        // Test file name is a string.
        $this->assertIsString($file);

        // Test file exist.
        $this->assertFileExists($file);

        $f = fopen($file, 'r');
        $line1 = fgetcsv($f);

        // Test for csv headers
        $this->assertEquals('Brand Name', $line1[0]);
        $this->assertEquals('Turnover (excluding VAT)', $line1[1]);
        
        // Test for csv data
        while ($line = fgetcsv($f)){
            $this->assertIsNumeric($line[1]);
        }
        fclose($f);
    }

    public function testTurnoverPerDay(){
        // Make a instance
        $TurnoverPerDay = new \otrium\reports\TurnoverPerDay();

        // Generate the report but ignore download
        $file = $TurnoverPerDay->generate(false);

        // Test file name is a string.
        $this->assertIsString($file);

        // Test file exist.
        $this->assertFileExists($file);

        $f = fopen($file, 'r');
        $line1 = fgetcsv($f);

        // Test for csv headers
        $this->assertEquals('Date', $line1[0]);
        $this->assertEquals('Turnover (excluding VAT)', $line1[1]);
        
        // Test for csv data
        while ($line = fgetcsv($f)){
            $this->assertIsNumeric($line[1]);
        }
        fclose($f);
    }
}
