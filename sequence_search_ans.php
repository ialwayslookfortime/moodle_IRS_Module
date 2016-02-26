<?php 
	session_start() ;
	require_once("connection/connection.php"); 
	$LessonID= $_SESSION['lesson_id'];
	$Exam_NO=$_SESSION['Exam_NO'];

	//尋找學生
	$SelectSequence="SELECT NAME,Student_id,Time FROM irs_ans_sequence WHERE LessonID='$LessonID'AND ExamNO='$Exam_NO' GROUP BY Student_id ORDER BY Time ASC";
	$SelectSequenceResult=mysqli_query($irs_conni,$SelectSequence);
	$i=0;
	//$name=array();
	//$Student_id=array();
	while($row=mysqli_fetch_row($SelectSequenceResult)){
		echo $row[0].'+'.$row[1].'+'.$row[2].'+';//$row[0]->學生姓名,$row[1]->學號

	}
?>