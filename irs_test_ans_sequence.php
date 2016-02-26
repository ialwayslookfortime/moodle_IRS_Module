<?php session_start() ;?>
<?php require_once("connection/connection.php"); ?>
<script type='text/javascript' src='sequence_to_ans.js'></script>
<?php
//$Exam_NO=$_SESSION['Exam_NO'];//考試編號
$LessonID= $_SESSION['lesson_id'];
$Now_No=$_GET["qno"];
$n=$Now_No-1;
$Exam_NO=$_SESSION['Exam_NO'];



?>
<script>
var LessonID=<?php echo $LessonID;?>;
var n=<?php echo $n;?>;
var Exam_NO=<?php echo $Exam_NO;?>;
</script>
<?php

$SelectSequence="SELECT NAME,Student_id FROM irs_ans_sequence WHERE LessonID='$LessonID'AND ExamNO='$Exam_NO'ORDER BY Time Desc";
$SelectSequenceResult=mysqli_query($irs_conni,$SelectSequence);
$i=0;
$name=array();
$Student_id=array();
while($row=mysqli_fetch_row($SelectSequenceResult))
{
	$name[$i]=$row[0];
	$Student_id[$i]=$row[1];
	$i++;
}
if($i>11)$i=11;//設定最多人數
for($j=0;$j<$i;$j++)
{
	echo "<script>var j=".$j.";</script>";
	echo "<script>var sid='".$Student_id[$j]."'</script>";
	echo $name[$j].$Student_id[$j]."<input type='checkbox' id='box".$Student_id[$j]."' name='".$Student_id[$j]."' value='go' onclick='sequence_to_ans(LessonID,n,Exam_NO,j,sid)'> <div id='num_".$j."'></div><br>";
	//echo $name[$j].$Student_id[$j]."<input type='checkbox' id='box".$Student_id[$j]."' name='".$Student_id[$j]."' value='go' onclick='sequence_to_ans(LessonID,n,Exam_NO,".$j.",".$Student_id[$j].")'> <div id='num'></div><br>";
}
?>
