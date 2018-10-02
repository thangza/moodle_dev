<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

$mysql_host = getenv('MYSQL_HOST') ?: 'localhost';
$mysql_user = getenv('MYSQL_USER') ?: 'root';
$mysql_password = getenv('MYSQL_PASSWORD') ?: '';

$connection_string = "mysql:host={$mysql_host};dbname=moodle";

$db = new PDO($connection_string, $mysql_user, $mysql_password);

class locallibTest extends TestCase{


  public function testTrueisTrue(){
    $foo = true;
    $this->assertTrue($foo);
  }

  public function test_get_feedback_witsoj(){
    global $DB = new PDO($connection_string, $mysql_user, $mysql_password);
    #$tester=new assign_feedback_witsoj;
    #$msg="gets feedback correctly works correctly";
    $sql="SELECT id FROM mdl_assignfeedback_witsoj WHERE id=1";
    $expected=$DB->get_record_sql($sql);
    #$result=$tester->get_feedback_witsoj(1);
    $this->assertEquals($expected,1,$msg);
  }




}
