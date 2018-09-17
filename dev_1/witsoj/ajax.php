<?php
#echo "Hello World" ;

#requiring this file so that we can access its functionality

require_once('../../../../config.php');

define('ASSIGNFEEDBACK_WITSOJ_STATUS_PENDING', 0);
define('ASSIGNFEEDBACK_WITSOJ_STATUS_JUDGING', 1);

$gradeid = $_POST['sendID'];
global $DB; 
#$sql = "SELECT ojfeedback FROM {assignfeedback_witsoj} s ".
#	" WHERE userid=".$id . " AND assignment = ".$assignid . 
#	" ORDER BY timemodified ASC ";
#$rec = $DB->get_records_sql($sql);

$feedbackcomment = $DB->get_record('assignfeedback_witsoj', array('grade'=>$gradeid));
$feedbackstatus = $feedbackcomment->status ;

if($feedbackstatus  == ASSIGNFEEDBACK_WITSOJ_STATUS_PENDING){
	echo "WAITING" ;

}elseif ($feedbackstatus  == ASSIGNFEEDBACK_WITSOJ_STATUS_JUDGING){
	echo "JUDGING" ;

}else{
	echo "GRADED";
	//echo $feedbackcomment->commenttext;
}


?>
