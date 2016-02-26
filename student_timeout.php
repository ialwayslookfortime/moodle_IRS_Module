<?php require_once('connection/connection.php'); ?>
<?php
	require_once('../config.php');
	require_once('../newconfig.php');
	require_once($CFG->dirroot.'../mod/resource/locallib.php'); 	
	
	$id   = optional_param('id', 0, PARAM_INT); //courseid
	$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
	require_login($course);
	
	$userid=$USER->idnumber;
	
	
	$da=date("Y-m-d H:i:s");
	$sql2="update irs_online_statues set date='$da' where user_id='$userid' ";
	$result2=mysqli_query($newconni,$sql2);	
?>
