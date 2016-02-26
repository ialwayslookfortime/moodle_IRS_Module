<?php require_once("connection/connection.php"); ?>
<?php
require_once('../config.php');
require_once('../newconfig.php');
require_once($CFG->dirroot.'../mod/resource/locallib.php');


//$Exam_NO=$_SESSION['Exam_NO'];//考試編號
$Exam_NO=$_GET['examno'];//考試編號
$OpenStatus = $_GET['starting'];
$LessonID= $_GET['id'];
//$LessonID= $_SESSION['lesson_id'];

//$Work_ID="271";
//$OpenStatus="1";
if($OpenStatus == 1 || $OpenStatus == 0 )
{
	$sql="select * from irs_online_exam_no where Exam_NO='$Exam_NO' order by date desc limit 0,1";
	$result=mysqli_query($newconni,$sql);
	$row=mysqli_fetch_row($result);
	$no=$row[0];
	$UpdateOpenStatus="UPDATE irs_online_exam_no SET open_to_answer='$OpenStatus'  WHERE   no='$no' ";
	mysqli_query($newconni,$UpdateOpenStatus);
}
if($OpenStatus ==3)
{
	$OpenStatusss=1;
	$sql="select * from irs_online_exam_no where Exam_NO='$Exam_NO' order by date desc limit 0,1";
	$result=mysqli_query($newconni,$sql);
	$row=mysqli_fetch_row($result);
	$no=$row[0];
	$UpdateOpenStatus="UPDATE irs_online_exam_no SET open_to_answer='$OpenStatusss'  WHERE   no='$no' ";
	mysqli_query($newconni,$UpdateOpenStatus);
	
	$SQL="DELETE FROM irs_ans_sequence WHERE Lesson_ID='$Lesson_ID'";
	mysqli_query($newconni,$SQL);
}
	

//echo $no;
?>