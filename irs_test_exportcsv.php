<script src="FileSaver.min.js"></script>
<meta charset="UTF-8">
<script>
var text="";

</script>
<?php
	require_once("connection/connection.php");
	require_once('../config.php');
	require_once('../newconfig.php');
	require_once($CFG->dirroot.'../mod/resource/locallib.php');
	
	
	$id   = optional_param('id', 0, PARAM_INT); //courseid
	$Exam_NO = optional_param('examno', 0, PARAM_INT); //examno
	$TotalPage = optional_param('TotalPage', 0, PARAM_INT);
	$Exam_Name=$_GET['examname'];
	$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
	require_login($course);
	$LessonID=$id;
	//$Exam_NO=$_SESSION['Exam_NO'];	
	//$LessonID=$_SESSION['lesson_id'];
    //$TotalPage=$_SESSION['Total_Page'];	
	//$Exam_Name=$_SESSION['Exam_Name'];
	$pgii=0;
	
	//$noppt=$_GET['qno'];
	//$n=$_GET['qno'];
	//$n=$n-1;
	
	$onlineornotSQL = "SELECT idnumber,username FROM (
SELECT ra.userid as bb FROM mdl_role_assignments ra WHERE ra.roleid = 5 AND ra.contextid IN (SELECT ctx.id FROM mdl_context ctx WHERE ctx.instanceid = 2)
) as a,mdl_user WHERE mdl_user.id=a.bb"; 
	//$onlineornotSQL = "SELECT * FROM pes_students_lessons WHERE lesson_id='$LessonID' "; 
	//$onlineornotQuery = mysqli_query($newconni,$onlineornotSQL);
	$onlineornotQuery = mysqli_query($newconni,$onlineornotSQL);
	$a=array();
	$b=array();
	$c=array();
	$d=array();
	$e=array();
	$f=array();
	
	
	$fortest=array();
	$fora=array();
	$forb=array();
	$forc=array();
	$ford=array();
	$fore=array();
	$forf=array();
	
 $i=0;
 $n=1;//控制題數
 $phptext="學號\題數,";
 //$phptext="studentid,";
echo"<table border=1>";
echo "<tr><td>學號\頁數</td>";
 for($Csvfirstrow=0;$Csvfirstrow<=$TotalPage;$Csvfirstrow++)
 {
	if($Csvfirstrow!=($TotalPage))
	{
		$phptext=$phptext.($Csvfirstrow+1).",";
		echo "<td>".($Csvfirstrow+1)."</td>";
	}
	else
	{
		//$phptext=$phptext.$Csvfirstrow;
		//echo "<td>".$Csvfirstrow."</td></tr><tr>";
		echo "</tr><tr>";
	}
 }
 $phptext=$phptext."\n";
 //echo $phptext;

 while($OnlineStudent = mysqli_fetch_row($onlineornotQuery))
 {
	
	$userid=$OnlineStudent[0];
	//$username=$OnlineStudent[2];
	$phptext=$phptext.$userid.",";
	echo "<td>".$userid."</td>";
	for($tt=0;$tt<$TotalPage;$tt++)
	{
		$local="exam_ppt/".$LessonID."/".$Exam_NO."/".$tt."_".$userid.".txt";
		$qoqoqo=fopen($local,'r');
		$mydata=fgets($qoqoqo,256);
		fclose($qoqoqo);
		//echo $userid."第".$tt."題回答".$mydata."</br>";
		if($tt!=$TotalPage)
		{
			$phptext=$phptext.$mydata.",";
			echo "<td>".$mydata."</td>";
		}
		else
		{
			$phptext=$phptext.$mydata;
			echo "<td>".$mydata."</td></tr><tr>";
		}
	}
	$phptext=$phptext."\n";
 }
 
	//echo $phptext;
	//$T = iconv("UTF-8","BIG5", $phptext);
	echo "</table>";
?>

<script>
//console.log("x");
//alert("x");

    var filename="<?php echo $Exam_Name;?>";
	var data = "\ufeff";  
    var str= data+'<?php echo str_replace(array("\\", "\r", "\n", "'"),array("\\\\", '\\r', '\\n', "\'"),$phptext) ?>';
	
//下載檔案用
	//console.log("");
	var blob = new Blob([str], {type: "csv/plain;charset=utf-8"});
    saveAs(blob, filename+".csv");

</script>

