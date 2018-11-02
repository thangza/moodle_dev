<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

#require_once('dev_1/witsoj/locallib.php');

class locallibTest extends TestCase{

  public function getConnection(){
    $mysql_host = getenv('MYSQL_HOST') ?: 'localhost';
    $mysql_user = getenv('MYSQL_USER') ?: 'root';
    $mysql_password = getenv('MYSQL_PASSWORD') ?: '';
    $connection_string = "mysql:host={$mysql_host};dbname=moodle";
    $db = new PDO($connection_string, $mysql_user, $mysql_password);
    return $db;
  }



  public function test_get_feedback_witsoj(){
    #global $DB;
    $db=$this->getConnection();
    $tester=new assign_feedback_witsoj;
    $result=$tester->get_feedback_witsoj(1);
    $stmt = $db->prepare("SELECT * FROM mdl_assignfeedback_witsoj WHERE id=1");
    $stmt->execute();
    $expected = $stmt->fetchObject();
    $this->assertEquals($expected,$result,"Correct");
  }

  public function test_get_editor_text(){
    $db=$this->getConnection();
    $tester=new assign_feedback_witsoj;
    $result=$tester->get_editor_text('comments',1);
    $stmt=$db->prepare("SELECT * FROM mdl_assignfeedback_witsoj WHERE id=1");
    $stmt->execute();
    $expected1 = $stmt->fetchObject();
    $expected=$expected1->commenttext;
    $this->assertEquals($expected,$result,"Correct");
  }

  public function test_view_summary_done(){
    $tester=new assign_feedback_witsoj;
    $result = $tester->view_summary(1);
    $expected = -2;
    $this->assertEquals($expected,$result,"Correct");
  }

  public function test_view_summary(){
    $db=$this->getConnection();
    $stmt=$db->prepare("UPDATE mdl_assignfeedback_witsoj SET status = 0 WHERE id=1");
    $stmt->execute();
    $tester=new assign_feedback_witsoj;
    $result = $tester->view_summary(1);
    $expected = 1;
    $this->assertEquals($expected,$result,"Correct");
  }

  public function testHello(){
    $tester=new assign_feedback_witsoj;
    $result=$tester->helloWorld();
    $this->assertEquals('Hello world',$result,'can access locallib');
  }

  public function testTrueisTrue(){
    $foo = true;
    $this->assertTrue($foo);
  }

}
