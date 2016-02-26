<?php //session_start() ;?>
<?php require_once("connection/connection.php"); ?>
<?php
require_once('../config.php');
require_once('../newconfig.php');
require_once($CFG->dirroot.'../mod/resource/locallib.php');
$id   = optional_param('id', 0, PARAM_INT); //courseid
$examno = optional_param('examno', 0, PARAM_INT); //examno

$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
require_login($course);

//$userid=$_SESSION['MM_Username'];
//$Exam_NO=$_GET['examno'];//考試編號
$Exam_NO=$examno;

//$LessonID=$COURSE->id;
//$LessonID=2;
$da=date("Y-m-d H:i:s");
//$id  = optional_param('id', 0, PARAM_INT); //courseid
$LessonID=$id;

$c = $_GET['qno'];
// -1為預設用
if($c==(-1))
{
	$a ="insert into irs_online_exam_no(Lesson_ID,Exam_NO,Question_NO,date) 
							values('$LessonID','$Exam_NO','0','$da')";
	mysqli_query($newconni,$a);
}
else
{
	$a ="UPDATE irs_online_exam_no   SET  Question_NO='$c'  WHERE  Lesson_ID='$LessonID' AND Exam_NO='$Exam_NO'  ";
	mysqli_query($newconni,$a);
}

?>
