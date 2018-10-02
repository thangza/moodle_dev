<?php
use PHPUnit\Framework\TestCase;

class locallibTest extends TestCase{
  public function testTrueisTrue(){
    $foo = true;
    $this->assertTrue($foo);
  }

  public function testDefine(){
    $msg="define pending works correctly";
    $this->assertEquals('ASSIGNFEEDBACK_WITSOJ_STATUS_PENDING',0,$msg);
  }




}
