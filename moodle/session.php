<?php
session_start();
$moodle_conni = mysqli_connect("140.127.220.17", "root", "mWZ4LYxn2bbaYUuS","moodle_irs_transfer");
// 將所有輸出設為 UTF-8

header('Content-Type: text/html; charset=UTF-8');

mysqli_query($moodle_conni,"SET NAMES 'UTF8'");
mysqli_query($moodle_conni,"SET CHARACTER SET UTF8");
mysqli_query($moodle_conni,"SET CHARACTER_SET_RESULTS=UTF8'");
mysqli_query($moodle_conni,"SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary");

$checkmd5=$_GET['uid'];
$chechid=$_GET['id'];

if(isset($checkmd5))
{
	echo $check;
	$CheckSql="SELECT * FROM moodle_irs_transfer WHERE uid='$checkmd5' AND id='$chechid' order by time DESC";
	$CheckSqlQuery=mysqli_query($moodle_conni,$CheckSql);
	$CheckSqlResult=mysqli_fetch_row($CheckSqlQuery);
	$otherservertime=$CheckSqlResult[3];
	$studentid=$CheckSqlResult[1];
	echo "220.17".$otherservertime."</br>";
	
	$da=date("Y-m-d H:i:s");
	$y=date("Y");
	$m=date("m");
	$d=date("d");
	echo "220.105:".$da;
	if(strtotime($da)-strtotime($otherservertime)<7)
	{
		//header('Location: http://www.yahoo.com.tw');
		echo "親愛的".$studentid."歡迎回來";
		$_SESSION['MM_Username']=$studentid;
		$_SESSION['lesson_id']="53";
		header('Location: http://140.127.220.105/IRS/index_student.php');
	}
	else
	{
		echo "timeout"; 
	}
}
else
{
	$nowtime =strtotime("now");//電腦時間
	//echo $nowtime;
	$da=date("Y-m-d H:i:s");
	$y=date("Y");
	$m=date("m");
	$d=date("d");
	echo "105:".$da;
	echo "沒有GET值";
}


?>