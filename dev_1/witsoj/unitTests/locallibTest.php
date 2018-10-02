<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

class locallibTest extends TestCase{

  public function testTrueisTrue(){
    $foo = true;
    $this->assertTrue($foo);
  }

  /*public function testGetFeedbackWitsOJ(){
    $mysql_host = getenv('MYSQL_HOST') ?: 'localhost';
    $mysql_user = getenv('MYSQL_USER') ?: 'root';
    $mysql_password = getenv('MYSQL_PASSWORD') ?: '';
    $connection_string = "mysql:host={$mysql_host};dbname=moodle";
    $db = new PDO($connection_string, $mysql_user, $mysql_password);
    $tester=new assign_feedback_witsoj;
    $msg="Awe";
    $sql="SELECT id FROM mdl_assignfeedback_witsoj WHERE id=1";
    $stmt=$db->prepare($sql);
    $stmt->execute();
    $expected = $stmt->fetchAll();
    $result=$tester->get_feedback_witsoj(1);
    $this->assertEquals($expected,$result,$msg);
  }*/

  public function testdbTest(){
    #global $DB;
    $mysql_host = getenv('MYSQL_HOST') ?: 'localhost';
    $mysql_user = getenv('MYSQL_USER') ?: 'root';
    $mysql_password = getenv('MYSQL_PASSWORD') ?: '';
    $connection_string = "mysql:host={$mysql_host};dbname=moodle";
    $db = new PDO($connection_string, $mysql_user, $mysql_password);
    $tester=new assign_feedback_witsoj;
    $result=$tester->get_feedback_witsoj(1);
    $stmt = $db->prepare("SELECT * FROM mdl_assignfeedback_witsoj WHERE id=1");
    $stmt->execute();
    $expected = $stmt->fetchAll();
    $this->assertEquals($expected,$result,"Yay!");
  }






}
