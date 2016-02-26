<?php require_once('connection/connection.php'); ?>
<?php
session_start();	
if(check('lesson_id')&&check('user_id')&&check('group')&&check('lesson_name')&&check('lesson_engname'))
{
	header("Location:index.php");
	$_SESSION['access_key']="allow";
}

?>




