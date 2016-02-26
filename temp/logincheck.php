<?php
session_start();
require_once("../connection/connection.php");
#$guestname=$_POST['guestname'];
if($_POST['guestname']==null)
{
	$GetGusetNOSQL="SELECT guest_no FROM guest ORDER BY no DESC LIMIT 0,1";
	$GetGusetNOResult=mysqli_query($irs_conni,$GetGusetNOSQL);//取得上一個Guest序號
	$GetGusetNOROW=mysqli_fetch_row($GetGusetNOResult);
	$Last_Guest_NO=$GetGusetNOROW[0];
		
	if($Last_Guest_NO==NULL)
	{
		$Now_Guest_NO="001";
		$guestname='G'.$Now_Guest_NO;
	}
	else
	{
		if(($Last_Guest_NO+1)>1000)
		{
			$Now_Guest_NO="001";
			$guestname='G'.$Now_Guest_NO;
		}
		else
		{
			if($Last_Guest_NO<9)
			{
				$Now_Guest_NO=$Last_Guest_NO+1;
				$Now_Guest_NO="00".$Now_Guest_NO;
				$guestname='G'.$Now_Guest_NO;
			}
			else if($Last_Guest_NO>8 && $Last_Guest_NO<99)
			{
				$Now_Guest_NO=$Last_Guest_NO+1;
				$Now_Guest_NO="0".$Now_Guest_NO;
				$guestname='G'.$Now_Guest_NO;
			}
				
		}
	}
	$GetGuestSQL="INSERT INTO guest(guest_no) VALUES('$Now_Guest_NO')";
	mysqli_query($irs_conni,$GetGuestSQL);
}
else
{
	$guestname='G'.$_POST['guestname'];
}
$_SESSION['guestname']=$guestname;
$LessonID="53";
$da=date("Y-m-d H:i:s");
if(eregi("[^a-zA-Z0-9]",$guestname)||(mb_strlen($guestname)>10))
{
	$_SESSION['chinex']=1;
	header("Location: templogin.php");
}
else if(isset($guestname) )
{	
	$_POST['guestname']=NULL;
	$SQL="INSERT INTO pes_students(user_id,user_pw,user_name,user_email,create_time) VALUES('$guestname','$guestname','$guestname','test@g.gal','$da')";
	mysqli_query($pes_conni,$SQL);
	$SQL2="INSERT INTO pes_students_lessons(user_id,lesson_id,user_validated) VALUES('$guestname','53','1')";
	mysqli_query($pes_conni,$SQL2);
	
	
	$_SESSION['MM_Username']=$guestname;
	$_SESSION['lesson_id']="53";
	$ExamNoSQL = "Select exam_no from irs_lesson where lesson_id='53'";//目前都先以53鎖死
	$ExamNoQuery = mysqli_query($irs_conni,$ExamNoSQL);
	$ExamNoResult = mysqli_fetch_row($ExamNoQuery);
	$ExamNo = $ExamNoResult[0];
	$i = 1;
	while($i<=$ExamNo)
	{
		
		$dataURL="../exam_ppt/".$LessonID."/".$ExamNo."alljpg.txt";
		$alljpgtxt = fopen($dataURL,'r');
		$Totalpages=fgets($alljpgtxt,256);
		$j=0;
		while($j<=$Totalpages)
		{
			$local="../exam_ppt/".$LessonID."/".$i."/".$j."_".$guestname.".txt";
			$qoqoqo=fopen($local,'w');
			fwrite($qoqoqo,'n');
			$j++;
		}
		$i++;
	}
	
	header("Location: ../index_student.php");
	echo "ok";
}
else
{
	header("Location: templogin.php");
}


?>