<?php
	require_once('../config.php');
	require_once('../newconfig.php');
	require_once($CFG->dirroot.'../mod/resource/locallib.php');
	

    //$catid       = optional_param('catid', 0, PARAM_INT);
    //$uid         = optional_param('uid', 0, PARAM_INT);
    $id   		 = optional_param('id', 0, PARAM_INT); //courseid
    //$name        = optional_param('name', '', PARAM_RAW);
	$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
	require_login($course);

	//print_r($USER);
$LessonID=$id;
echo $LessonID;
$LessonSQL = "SELECT lesson_id,exam_no,exam_name from irs_lesson where lesson_id ='$LessonID'ORDER BY no DESC";
$LessonQuery=mysqli_query($newconni,$LessonSQL);
/*while($LessonResult=mysqli_fetch_row($LessonQuery))
echo $LessonResult[1]; //該課程中所有考試*/
//$before_url=$_SESSION['before_url'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="index.css">
		<meta charset="UTF-8">
		<title>IRS</title>		
	</head>
	<body>
		<div >
			<form action="upload.php?id=<?php echo $id;?>" method="post"  enctype="multipart/form-data">
			<h1>新增考試</h1>
			<table border=1>
			<tr>
				<td>考試名稱</td>
				<td><input type="text" name="exam_name" size="20"></td>
			</tr>	
			<tr>
				<td>上傳PPT</td>
				<td><input type="file" name="file" size="20"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="新增考試" size="20"></td>
			</tr>
			</table>
			</form>
		</div>
		<div class="all">
		<form action="irs_test.php?id=<?php echo $id;?>" method="post">
		<div class="Exam_div">
		  <select name="Exam_ALL" class="Exam_ALL" style="height:100px;width:400px;font-size:35px;" >
			<?php				
				while($LessonResult=mysqli_fetch_row($LessonQuery))
				{
					echo "<option value='".$LessonResult[1]."_zaybxc_".$LessonResult[2]."_zaybxc_".$id." 'style='text-align:center ;' >".$LessonResult[2]."</option>";					
				}
			?>
		  </select><br>
		  <input type="submit" value="進入考場" style="height:100px;width:400px;font-size:35px;">
		</form>	
		</div>
		</div>
	
	<input type='button' value='刪除考試' style="height:100px;width:400px;font-size:35px;margin-left:500px;" onclick="location.href='teacher_delete_exam.php' "><br>	
	</body>
</html>

