<?php 
require_once('connection/connection.php');
session_start();
$LessonID= $_SESSION['lesson_id'];
$LessonSQL = "SELECT lesson_id,exam_no,exam_name,no,date from irs_lesson where lesson_id ='$LessonID'ORDER BY no DESC";
$LessonQuery=mysqli_query($irs_conni,$LessonSQL);
?>
<script type="text/javascript">
<!--
	function selAll(){
		var checkItem = document.getElementsByName("delete[]");
		var obj= document.getElementById("checkall");
		if(obj.checked==true){
		for(var i=0;i<checkItem.length;i++){
			checkItem[i].checked=true;   
		}
		}else{
		for(var i=0;i<checkItem.length;i++){
			checkItem[i].checked=false;
		}
		}
	}
//-->
</script>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="index.css">
		<meta charset="UTF-8">
		<title>IRS</title>		
	</head>
	<body>
		<div class="all">
		<form action="" method="post">
		<div class="Exam_div">
		<table border="1">
　<tr>
	<td>考試名稱</td><td>創建日期</td><td><input type="checkbox" name="checkall" value="checkbox" onclick="selAll();" id="checkall">刪除</td>
	</tr>
	<?php 
	while($LessonResult=mysqli_fetch_row($LessonQuery))
	{
		echo "<tr>";
		echo "<td>".$LessonResult[2]."</td>";
		echo "<td>".$LessonResult[4]."</td>";
		echo "<td><input type='checkbox' value='".$LessonResult[3]."' name='delete[]'></td>";
		echo "</tr>";
	}	
    ?>

</table>

		  <input type="submit" value="確定刪除" style="height:100px;width:400px;font-size:35px;">
		</form>	
		</div>
		</div>
<input type='button' value='回到PES' style="height:100px;width:400px;font-size:35px;margin-left:500px;" onclick="location.href='../works.php?lessonid=<?php echo $LessonID;?>' "><br>
	
	</body>
</html>
<?php 
if($_POST['delete']!=NULL)
{
	$delete=$_POST['delete'];
	for($i=0;$i<count($delete);$i++)
	{
		$Exam_NO=$delete[$i];
		if($Exam_NO)
		{
			$DeleteSQL="DELETE FROM irs_lesson WHERE no='$Exam_NO' ";
			mysqli_query($irs_conni,$DeleteSQL);
			$path="c:\\wamp\\www\\IRS\\exam_ppt\\".$LessonID."\\";
			$path=$path.$Exam_NO;
			deleteDirectory($path);
		}
	}
	header("Location:teacher_delete_exam.php");
}


?>
