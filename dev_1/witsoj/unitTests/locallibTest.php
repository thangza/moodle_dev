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
  public function test_view_page_lecturer_compile_error(){
    $db=$this->getConnection();
    $tester=new assign_feedback_witsoj;
    $pluginaction="viewdetails";
    $witsoj_assignment_id = 11;
    $witsoj_assign_userid = 5;
    $can_rejudge_variable = True;
    $stmt=$db->prepare("SELECT ojtests FROM mdl_assignfeedback_witsoj WHERE
    (assignmentcontextid = '$witsoj_assignment_id' AND userid = '$witsoj_assign_userid')");
    $stmt->execute();
    $rec = $stmt->fetchColumn();
    /*foreach ($rec as $ojtests => $v) {
        $jsond = json_decode($ojtests, true) ;
    }*/
    $jsond = json_decode($rec, true);
    $result=$tester->view_page($pluginaction, $witsoj_assignment_id, $witsoj_assign_userid, $can_rejudge_variable);
    $this->assertEquals($jsond[0]['stderr'], $result);
  }
    public function test_view_page_student_compile_error(){
      $db=$this->getConnection();
      $tester=new assign_feedback_witsoj;
      $pluginaction="viewdetails";
      $witsoj_assignment_id = 11;
      $witsoj_assign_userid = 5;
      $can_rejudge_variable = False;
      $stmt=$db->prepare("SELECT ojtests FROM mdl_assignfeedback_witsoj WHERE
      (assignmentcontextid = '$witsoj_assignment_id' AND userid = '$witsoj_assign_userid')");
      $stmt->execute();
      $rec = $stmt->fetchObject();
      foreach ($rec as $ojtests => $v) {
          $jsond = json_decode($ojtests, true) ;
      }
      //$jsond = json_decode($rec, true) ;
      $result=$tester->view_page($pluginaction, $witsoj_assignment_id, $witsoj_assign_userid, $can_rejudge_variable);
      $this->assertEquals($jsond[0]['stderr'], $result);
    }

    public function test_view_page_lecturer_model_out(){
      $db=$this->getConnection();
      $tester=new assign_feedback_witsoj;
      $pluginaction="viewdetails";
      $witsoj_assignment_id = 1;
      $witsoj_assign_userid = 2;
      $can_rejudge_variable = True;
      $stmt=$db->prepare("SELECT ojtests FROM mdl_assignfeedback_witsoj WHERE
      (assignmentcontextid = '$witsoj_assignment_id' AND userid = '$witsoj_assign_userid')");
      $stmt->execute();
      $rec = $stmt->fetchColumn();
      /*foreach ($rec as $ojtests => $v) {
          $jsond = json_decode($ojtests, true) ;
      }*/
      $jsond = json_decode($rec, true) ;
      $result=$tester->view_page($pluginaction, $witsoj_assignment_id, $witsoj_assign_userid, $can_rejudge_variable);
      $this->assertEquals($jsond[0]['progout'].$rec[0]['modelout'], $result);
    }
    public function test_view_page_student_model_out(){
      $db=$this->getConnection();
      $tester=new assign_feedback_witsoj;
      $pluginaction="viewdetails";
      $witsoj_assignment_id = 1;
      $witsoj_assign_userid = 2;
      $can_rejudge_variable = False;
      $stmt=$db->prepare("SELECT ojtests FROM mdl_assignfeedback_witsoj WHERE
      (assignmentcontextid = '$witsoj_assignment_id' AND userid = '$witsoj_assign_userid')");
      $stmt->execute();
      $rec = $stmt->fetchColumn();
      /*foreach ($rec as $ojtests => $v) {
          $jsond = json_decode($ojtests, true) ;
      }*/
      $jsond = json_decode($rec, true) ;
      $result=$tester->view_page($pluginaction, $witsoj_assignment_id, $witsoj_assign_userid, $can_rejudge_variable);
      $this->assertEquals("Nothing to display", $result);
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
