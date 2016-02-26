<?php session_start() ;?>
<?php require_once("connection/connection.php"); 
$LessonID= $_SESSION['lesson_id'];
$guestname=$_SESSION['guestname'];
$da=date("Y-m-d H:i:s");
if(isset($_POST['Exam_ALL']))
{
	$_SESSION['Exam_ALL']=$_POST['Exam_ALL'];
}
$postdata= preg_split("/_zaybxc_/",$_SESSION['Exam_ALL']);//切開post的資料
$Exam_NO=$postdata[0];//考試編號
$_SESSION['Exam_NO']=$Exam_NO;
$Exam_Name=$postdata[1];//考試名稱
//echo $Exam_NO;
echo "<h1>您目前使用的學號：".$_SESSION['MM_Username']."</h1>";
?>
<script src="answer.js"></script> 


<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8;"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title></title>
<style>@media only screen and (-webkit-device-pixel-ratio: 2) {}</style>
<!-- 引入 jQuery(非必要,去掉時有些寫法要改為javascript) -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<!-- 引入AJAX(必要) -->
<script type="text/javascript" src="student_answer_examno.js"></script> 
<script type="text/javascript" src="student_timeout.js"></script> 
<script type="text/javascript">/*
function open()
{
	var ans_a = document.getElementById("ansa");
	var ans_b = document.getElementById("ansb");
	var ans_c = document.getElementById("ansc");
	var ans_d = document.getElementById("ansd");
	var ans_e = document.getElementById("anse");
	
	ans_a.style.display = "inline";
	ans_b.style.display = "inline";
	ans_c.style.display = "inline";
	ans_d.style.display = "inline";
	ans_e.style.display = "inline";
}
function close()
{
	var ans_a = document.getElementById("ansa");
	var ans_b = document.getElementById("ansb");
	var ans_c = document.getElementById("ansc");
	var ans_d = document.getElementById("ansd");
	var ans_e = document.getElementById("anse");
	
	ans_a.style.display = "none";
	ans_b.style.display = "none";
	ans_c.style.display = "none";
	ans_d.style.display = "none";
	ans_e.style.display = "none";
}
examno_ajax('')//抓取目前題數*/
time_ajax('')//存取時間
</script>
<script>
/*function finalans()
{		
	window.location.href = 'index.php';
}*/
</script>
</head>
<body>
<!--<div>以ajax實現頁面不刷新,從前端將值傳送到後端處理,並且回傳給前端顯示</div>-->
<div  id="show_area"></div>
<input align='left' id='ansa' type="image" img src="Letters/a.jpg" value="A"    width="30%" height="25%" onclick="ans('a')">
<input align='center' id='ansb' type="image" img src="Letters/b.jpg" value="B"	width="35%" height="25%" onclick="ans('b')">
<input align='right' id='ansc' type="image" img src="Letters/c.jpg" value="C"	width="30%" height="25%" onclick="ans('c')"><br><br><br>
<input align='left' id='ansd' type="image" img src="Letters/d.jpg" value="D"	width="30%" height="25%" onclick="ans('d')">
<input align='center' id='anse' type="image" img src="Letters/e.jpg" value="E"	width="35%" height="25%" onclick="ans('e')">
<input align='right' id='ansf' type="image" img src="Letters/f.jpg" value="F"	width="30%" height="25%" onclick="ans('f')"><br>
<input  id='ansz' type="image" img src="Letters/sequence.jpg" style="marign-left:50%;margin-top:10%;" value="O"	width="40%" height="30%" onclick="ans('o')">
<input  id='ansz' type="image" img src="Letters/zz.jpg" style="marign-left:50%;margin-top:10%;" value="Z"	width="40%" height="30%" onclick="ans('z')">
</body>
<script type="text/javascript">
//examno_ajax('')
//document.getElementById("show_area").innerHTML = 
//document.location.href="http://google.com";
</script>

</html>


