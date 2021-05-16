<?php
/**
 * Unit test for DB
 * -----------------
 *
 * Developed by Dananjaya M. Perera (dananjjaya01@gmail.com)
 * 
 */

require_once "config.php";
require_once "otrium/db.php";

class DBTest extends \PHPUnit\Framework\TestCase
{
    public function testDBConnection(){
        // Making a instance of DB
        $DB = new \otrium\DB();

        // Test for connection
        $this->assertInstanceOf('\PDO', $DB->connect());

        // Test connection status
        $this->assertTrue($DB->isConnected());
    }
}
