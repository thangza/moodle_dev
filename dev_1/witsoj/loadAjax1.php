<?php

function loadAjax(){
	$id = $_GET["gradeid"] ;
	return $id;
}

?>

setInterval(function(){
	var id = <?php echo $id ?> ;
	$.ajax({
		url: 'feedback/witsoj/ajax.php',
		type :"POST",
		data:{sendID: id},
		success: function(response){
			console.log("Hello");
			console.log(id);
			if(response != "GRADED"){
				$("#tmp").html(response);
			}else{
				location.reload() ;
			}
		},
		error: function(status){
			console.log(id);
			alert(JSON.stringify(status,null,4)) ;
		}

	});

},1000)
