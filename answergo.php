<?php
require_once('connection/connection.php'); 
require_once('../config.php');
require_once('../newconfig.php');
require_once($CFG->dirroot.'../mod/resource/locallib.php');

$id   = optional_param('id', 0, PARAM_INT); //courseid
$examno = optional_param('examno', 0, PARAM_INT); //examno
$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
require_login($course);


$LessonID=$id;
$Exam_NO=$examno;
$userid=$USER->idnumber;
/*
$LessonID= $_SESSION['lesson_id'];
$Exam_NO=$_SESSION['Exam_NO'];
$userid=$_SESSION['MM_Username'];
$guestname=$_SESSION['guestname'];
$Realname=$_SESSION['MM_Realname'];
*/
/*
if(isset($guestname))
{
	$writename=$guestname;
}
else if(isset($Realname))
{
	$writename=$Realname;
}
*/
//echo $LessonID."<br>";
//echo $userid."<br>";
//echo $Exam_NO."<br>";
//------------------------------------
 /*判斷是否可以回答*/
$sql="select * from irs_online_exam_no where Lesson_ID='$LessonID' AND Exam_NO='$Exam_NO' ORDER BY date DESC LIMIT 0,1";
$result=mysqli_query($newconni,$sql);
$row=mysqli_fetch_row($result);
$canans=$row[5];
$Question_NO=$row[3];
//echo $Question_NO;

//------------------------------------

$ans = $_GET['ans'];/* 傳過來的答案*/
if($ans=="o")
{
	$InserDBSQL="INSERT INTO irs_ans_sequence(LessonID,ExamNO,NAME,Student_id) VALUES('$LessonID','$Exam_NO','$Realname','$userid')";
	$InserDBSQLResult=mysqli_query($newconni,$InserDBSQL);
}
else
{
	if($canans==1)
	{
	$local="exam_ppt/".$LessonID."/".$Exam_NO."/".$Question_NO."_".$userid.".txt";
	$fp=fopen($local,'w');
	fwrite($fp,$ans);
	fclose($fp);
	/*
	$path2="exam_ppt/".$LessonID."/".$Exam_NO."/".$Question_NO."_first.txt";
		if( !is_file($path2) && $ans!="z")
			{
				//$path2="/exam_ppt/".$LessonID."/".$Exam_NO."/".$Question_NO."_first.txt";
				$str = strtoupper($ans);//強制大寫
				$gogogo=fopen($path2,'w');
				fwrite($gogogo,$writename."回答".$str);
				fclose($gogogo);
			}
	*/
	}
}


/*
$local="exam_ppt/".$LessonID."/".$Exam_NO."/".$Question_NO."_".$userid.".txt";
$fp=fopen($local,'w');
fwrite($fp,'a');
fclose($fp);
*/
?>
