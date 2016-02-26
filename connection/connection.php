<?php
$file_directory="c:\\wamp\\www\\";
$irs_conni = mysqli_connect("localhost", "", "","moodle");
//$irstemp_conni = mysqli_connect("localhost", "root", "nukimytao","tempirs");
// 將所有輸出設為 UTF-8
header('Content-Type: text/html; charset=UTF-8');
mysqli_query($irs_conni,"SET NAMES 'UTF8'");
mysqli_query($irs_conni,"SET CHARACTER SET UTF8");
mysqli_query($irs_conni,"SET CHARACTER_SET_RESULTS=UTF8'");
mysqli_query($irs_conni,"SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary");

//---config---
//--函數區
//時間函數
$nowtime =strtotime("now");//電腦時間
//echo $nowtime;
//$da=date("Y-m-d H:i:s");
$y=date("Y");
$m=date("m");
$d=date("d");
//--------


?>

