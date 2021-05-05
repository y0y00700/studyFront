<?php
	header("access-control-allow-origin: *");

	
	if(!isset($_POST['user_id']) || 
	!isset($_POST['user_pw'])) exit;

	$user_id = $_POST['user_id'];
	$user_pw = $_POST['user_pw'];

	$members = array(
		'korean'=>array('pw'=>'12345', 
		'name'=>'박부장'),
		'seoul'=>array('pw'=>'56789', 
		'name'=>'홍대리')
	);

	if(isset($members[$user_id]) &&  
	$members[$user_id]['pw'] == $user_pw) {
		echo '{"user_id":"'.$user_id.'", 
		"user_name": "'.$members[$user_id]['name'].'"}';
	}

	//DB연동해서 select
?>
