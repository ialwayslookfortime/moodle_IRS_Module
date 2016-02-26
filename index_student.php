<?php
	//  Display the course home page.
	//session_start();
	require_once('../config.php');
	require_once('../newconfig.php');
	require_once($CFG->dirroot.'../mod/resource/locallib.php');
	

    $catid       = optional_param('catid', 0, PARAM_INT);
    $uid         = optional_param('uid', 0, PARAM_INT);
    $id   		 = optional_param('id', 0, PARAM_INT); //courseid
    $name        = optional_param('name', '', PARAM_RAW);
	
	$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
	require_login($course);
	//print_r($USER);
	//$_SESSION['LessonID']=$id;
/*
    $params = array();
    if (!empty($name)) {
        $params = array('shortname' => $name);
    } else if (!empty($idnumber)) {
        $params = array('idnumber' => $idnumber);
    } else if (!empty($id)) {
        $params = array('id' => $id);
    }else {
        print_error('unspecifycourseid', 'error');
    } 
	
*/
//require_once('connection/connection.php');
//session_start();
//$LessonID= $_SESSION['lesson_id'];
$LessonSQL = "SELECT lesson_id,exam_no,exam_name from irs_lesson where lesson_id ='$id'ORDER BY no DESC";
$LessonQuery=mysqli_query($newconni,$LessonSQL);
echo $id;
/*while($LessonResult=mysqli_fetch_row($LessonQuery))
echo $LessonResult[1]; //該課程中所有考試*/
//$before_url=$_SESSION['before_url'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>IRS</title>
		<style>
		.Exam_div
		{
			font-size:500%;
			margin-top:20%;
			text-align:center;
			
		}
		</style>
	</head>
	<body>
		<div class="all" >
			
			<div class="Exam_div">
				<form action="student_answer.php" method="post">
				  <select name="Exam_ALL" class="Exam_ALL" style="height:80%;width:80%;font-size:130%;" >
					<?php				
						while($LessonResult=mysqli_fetch_row($LessonQuery))
						{
							echo "<option value='".$LessonResult[1]."_zaybxc_".$LessonResult[2]."_zaybxc_".$id."'style='text-align:center ;' >".$LessonResult[2]."</option>";					
						}
					?>
				  </select><br>
				  <input type="submit" value="進入考場" style="margin-top:10%;height:80%;width:80%;font-size:130%;">
				</form>
				<!--<input type='button' value='回到PES' style="margin-top:10%;height:80%;width:80%;font-size:130%;" onclick="location.href='../works.php?lessonid=<?php //echo $LessonID;?>' "><br>-->		
			</div>
		</div>
	</body>
</html>