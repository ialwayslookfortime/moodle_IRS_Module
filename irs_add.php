<?php
require_once('connection/connection.php');
session_start();
if(isset($_GET['work_id']))
{
	$LessonID=$_GET['work_id'];//其實是lesson_id  避免有人亂上傳
	$_SESSION['LessonID']=$LessonID;
}
else
{
	echo "請重新進入課程";
	//header($tranfer);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="upload.php" method="post"  enctype="multipart/form-data">
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
		<td><input type="submit" value="新增考試" size="20">
		<input type="button" value="取消" onclick="location.href='http://<?php echo $pesip?>/works.php'"></td>
	</tr>
	</table>
	</form>
</body>
</html>

