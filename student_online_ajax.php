<!DOCTYPE html>
<?php //session_start() ;?>
<html>
<link rel="stylesheet" type="text/css" href="timetochange_main.css">
<body id="ooooooo" style="background-color:#BBE2FF;">
<?php 
    require_once('connection/connection.php');
	require_once('../config.php');
	require_once('../newconfig.php');
	require_once($CFG->dirroot.'../mod/resource/locallib.php');
	//$USER=>lessonid->"4";
	//print_r($USER);
	
	//$id=$_SESSION['LessonID'];
	$id  = optional_param('id', 0, PARAM_INT); //courseid
	$examno  = optional_param('examno', 0, PARAM_INT); //examno
	$Exam_NO=$examno;//考試編號
	$LessonID=$id;
	
	//echo "id=".$id."<br>exam_no=".$Exam_NO."<br>";
	//print_r($COURSE);
	//print_r($USER);
	
	
	$onlineornotSQL = "SELECT * FROM irs_online_statues WHERE lesson_id='$LessonID' "; 
	$onlineornotQuery = mysqli_query($newconni,$onlineornotSQL);
	
	$i=0;
	
	$da=date("Y-m-d H:i:s");
	$OnlineStatus = "<div id =online></div>";
	$OfflineStatus = "<div id =offline></div>";
	$AnswerStatus = "<div id =answer></div>";
	$hesitateStatus = "<div id =hesitate></div>";
	echo"<table border=1>";
	echo "<tr>";
	
	$ai=1;
	$onlinepeople=0;
	$hadans=0;
	$Offpeople=0;
	$line_length=3;
	
	//----------------------------------------------------------------------------
	//$NowNo=0;//預設0
	
	$NowExamNo="SELECT Question_NO FROM irs_online_exam_no WHERE Lesson_ID='$LessonID' AND Exam_NO='$Exam_NO' ORDER BY date DESC LIMIT 0,1";
	$ResultNowNo=mysqli_query($newconni,$NowExamNo);
	$NowNoRow=mysqli_fetch_row($ResultNowNo);
	$NowNo=$NowNoRow[0];
	if(($NowNo)=="")
	{
		$NowNo=0;//預設0
	}
	//echo $NowNo;
	//----------------------------------------------------------------------------
	while($OnlineStudent = mysqli_fetch_row($onlineornotQuery))
	{
			
			if($i%$line_length==0){echo "</tr><tr>";}
			$Status = 0;
			if(strtotime($da)-strtotime($OnlineStudent[4])<1900)
			{	
				
				echo "<td>";
				$onlinepeople=$onlinepeople+1;
				//--------0928
				$local="exam_ppt/".$LessonID."/".$Exam_NO."/".trim($NowNo)."_".$OnlineStudent[1].".txt";
				//$local = "exam_ppt\340\2_A1013352.txt";
				
				@$qoqoqo=fopen($local,'r');			
				@$mydata=fgets($qoqoqo,24);
				@fclose($qoqoqo);
				//--------0928
				if($mydata!=null &&trim($mydata) !='n' &&  trim($mydata) !='z')//($AnswerOrNotSQLResult!=NULL)  &&(trim($AnswerOrNotSQLResult[6])!="n")
				{					
					
					$hadans=$hadans+1;
					$Nowtime=date("Y-m-d H:i:s");
					//$AnsweredTime= (int)((strtotime($Nowtime)-strtotime($AnswerOrNotSQLResult[7]))/60);//幾分鐘之前作答的
					echo $AnswerStatus.$OnlineStudent[2];//作答狀態
					echo "</td>";	
				}
				else if(trim($mydata) =='z')
				{
					$hadans=$hadans+1;
					$Nowtime=date("Y-m-d H:i:s");
					//$AnsweredTime= (int)((strtotime($Nowtime)-strtotime($AnswerOrNotSQLResult[7]))/60);//幾分鐘之前作答的
					echo $hesitateStatus.$OnlineStudent[2];//猶豫狀態
					echo "</td>";
				}
				else
				{					
					//if($i%3==0){echo "</tr><tr>";}
					echo $OnlineStatus.$OnlineStudent[2];//上線狀態
					echo "</td>";	
				}
				
			}
			else
			{	
				if($LessonID!="53")//來賓
				{
					$Offpeople=$Offpeople+1;
					echo "<td>";
					echo $OfflineStatus.$OnlineStudent[2];//離線狀態
					echo "</td>";
				}
				
			}
			
			$i++;//判斷一行有幾個人(預計要兩行)
			$ai++;
	}
	$allpoeple=$onlinepeople+$Offpeople;
	echo "</tr>";
	echo "<tr>";
	echo "<td>上線:".$onlinepeople."</td>";
	echo "<td>已作答:".$hadans."</td></tr><tr>";
	echo "<td>離線:".$Offpeople."</td>";
	echo "<td>總數:".$allpoeple."</td>";
	
	echo "</tr>";
	echo"</table>";

//echo "11";
?>
</html>