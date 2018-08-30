<?php


require_once('../../../../config.php');
require_once($CFG->dirroot . '/mod/assign/feedback/witsoj/locallib.php');
require_once($CFG->libdir . '/gradelib.php');
$grade ;
$status ;

function loadAjax(stdClass $grade){
	$feedback = get_feedback_witsoj($grade->id);
	$GLOBALS['grade'] = $grade ;
	$GLOBALS['status']= $feedback-status ;
}


?>

<script>
    var JSgrade = <?=$grade?> ;
</script>

<script>
	set_interval(function doAjax(){
		var ajax = new XMLHttpRequest();
		var method = "POST";
		var url = "locallib.php";

		ajax.open(method,url,true);
		ajax.send();
		
		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){

			}
		}
	},1000) ;

</script>