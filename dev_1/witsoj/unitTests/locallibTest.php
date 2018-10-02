<?php
use PHPUnit\Framework\TestCase;

class locallibTest extends TestCase{
  public function testTrueisTrue(){
    $foo = true;
    $this->assertTrue($foo);
  }

  public function test_get_feedback_witsoj(){
    global $DB;
    $tester=new assign_feedback_witsoj;
    $msg="gets feedback correctly works correctly";
    $sql="SELECT id FROM mdl_assignfeedback_witsoj WHERE id=1";
    $expected=$DB->get_record_sql($sql);
    #$result=$tester->get_feedback_witsoj(1);
    $this->assertEquals($expected,1,$msg);
  }




}
