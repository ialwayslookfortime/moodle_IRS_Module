<?php session_start() ;?>
<?php require_once("connection/connection.php"); ?>
<?php
//$Exam_NO=$_SESSION['Exam_NO'];//考試編號
$LessonID=$_GET['lessonid'];
$Exam_NO=$_GET['examno'];
$n=$_GET['n'];
$Student_id=$_GET['userid'];
@$local="./exam_ppt/".$LessonID."/".$Exam_NO."/".$n."_".$Student_id.".txt";
	@$qoqoqo=fopen($local,'r');
	@$mydata=fgets($qoqoqo,256);
	@fclose($qoqoqo);
echo strtoupper($mydata);
//echo "ok";
//echo $LessonID;
//echo $Student_id;
//echo $n;
?>