<?php 
require_once('connection/connection.php');
require_once('../config.php');
require_once('../newconfig.php');
require_once($CFG->dirroot.'../mod/resource/locallib.php');
$id   = optional_param('id', 0, PARAM_INT); //courseid
//$fileexamno = optional_param('fileexamno', 0, PARAM_INT); //examno

$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
require_login($course);

 
$LessonID= $id;
$File_Exam_NO=$_GET['fileexamno'];
$exam_no=$_GET['examno'];
$exam_no=$exam_no-1;



	//$UserDBSQL="select user_id from pes_students_lessons where lesson_id='$LessonID' order by user_id asc";
	$UserDBSQL="SELECT idnumber,username FROM (
SELECT ra.userid as bb FROM mdl_role_assignments ra WHERE ra.roleid = 5 AND ra.contextid IN (SELECT ctx.id FROM mdl_context ctx WHERE ctx.instanceid = '$id')
) as a,mdl_user WHERE mdl_user.id=a.bb";
	$UserDBResult = mysqli_query($newconni,$UserDBSQL);
	$pgii=$exam_no;//修改答案為n
	 while($UserEchoResult = mysqli_fetch_row($UserDBResult))
	{

		$local="exam_ppt/".$LessonID."/".$File_Exam_NO."/".$pgii."_".$UserEchoResult[0].".txt";
		$qoqoqo=fopen($local,'w');
		fwrite($qoqoqo,'n');
		fclose($qoqoqo);
	}
	
	//$path2="C:/wamp/www/IRS/exam_ppt/".$LessonID."/".$File_Exam_NO."/".$exam_no."_first.txt";
	//unlink($path2);

	
	/*$local2="./test.txt";
	$fp=fopen($local2,'w');
	//fwrite($fp,$local);
	fwrite($fp,"ok");
	fclose($fp);*/
?>