<?php
#echo "Hello World" ;

#requiring this file so that we can access its functionality

require_once('../../../../config.php');

define('ASSIGNFEEDBACK_WITSOJ_STATUS_PENDING', 0);
define('ASSIGNFEEDBACK_WITSOJ_STATUS_JUDGING', 1);

$gradeid = $_POST['sendID'];
global $DB;

// $sql = "SELECT * FROM {assignfeedback_witsoj} s ".
// 	" WHERE userid=".$id . " AND assignment = ".$assignid .
// 	" ORDER BY timemodified ASC ";
// $rec = $DB->get_records_sql($sql);

$feedbackcomment = $DB->get_record('assignfeedback_witsoj', array('grade'=>$gradeid));
$feedbackstatus = $feedbackcomment->status ;
$assignmentid = $feedbackcomment->assignment;


if($feedbackstatus  == ASSIGNFEEDBACK_WITSOJ_STATUS_PENDING){
	console.log("reached if statement");
	$sql = " SELECT position FROM
		(SELECT grade, @position := @position + 1 as position FROM
		(SELECT @position := 0) A,
		(SELECT * FROM mdl_assignfeedback_witsoj WHERE status= 0 ORDER BY timemodified ASC) B
	    WHERE assignment= '$assignmentid') C
	    WHERE grade = '$gradeid'";
	$rec = $DB->get_records_sql($sql); // queries the datebase
	foreach($rec as $position => $v){
		echo "Your position in the queue is " .$position;
	}

}elseif ($feedbackstatus  == ASSIGNFEEDBACK_WITSOJ_STATUS_JUDGING){
	console.log("reached elseif statement");
	echo "Judging" ;

}else{
	console.log("reached else statement");
	echo "GRADED";
	//echo $feedbackcomment->commenttext;
}


?>
