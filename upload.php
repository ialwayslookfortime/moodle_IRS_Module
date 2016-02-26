<?php
require_once('connection/connection.php');
require_once('../config.php');
require_once('../newconfig.php');
require_once($CFG->dirroot.'../mod/resource/locallib.php');
$id    = optional_param('id', 0, PARAM_INT); //courseid
$LessonID=$id;

//$Lesson_ID=131; //test  
  /*路徑*/  
  /*lesson_id+時間*/
  //$_POST['exam_name']="XXXXXXXXX";
$nowtime =strtotime("now");//電腦時間
//echo $nowtime;
//$da=date("Y-m-d H:i:s");
$y=date("Y");
$m=date("m");
$d=date("d");
if(($_POST['exam_name'])!=NULL)
{
 
	$exam_name=$_POST['exam_name'];
	$LastExamSQL="SELECT exam_no FROM irs_lesson WHERE lesson_id='$LessonID' ORDER BY no DESC";
	$LastExamSQLRESULT= mysqli_query($newconni,$LastExamSQL);
	$LastExamROW=mysqli_fetch_row($LastExamSQLRESULT);	
	if(isset($LastExamROW[0]))
	{
		$NowExam_NO=$LastExamROW[0]+1;
	}
	else
	{
		$NowExam_NO=1;
	}
	//------------路徑
	$work_file_path = "exam_ppt/".$LessonID."/";
	
	
	@mkdir($work_file_path);//建立資料夾(一次只能一層)
	$work_file_path=$work_file_path.$NowExam_NO."/";
	@mkdir($work_file_path);
	$ptt_txt=$work_file_path;
	$work_file_path = $work_file_path. $y . "_".$m. "_".$d. "/";
	$img_fold_for_ir_test=$work_file_path;
	@mkdir($work_file_path);//建立資料夾
	$ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $_FILES['file']['name']);//正規化附檔名
	@$object_path .=$work_file_path.$nowtime.".".$ext;
	//echo $object_path;
	if($ext=="ppt" || $ext=="pptx" )
	{
	
		if(move_uploaded_file($_FILES["file"]["tmp_name"],trim("$object_path")))
		{
			$ExamAddSQL="INSERT INTO irs_lesson(lesson_id,exam_no,exam_name,ppt) 
			VALUES('$LessonID','$NowExam_NO','$exam_name','$object_path')";	
			mysqli_query($newconni,$ExamAddSQL);
			echo "成功新增考試<br>";			
			//echo "<input type='button' value='進入考場' onclick='location.href=\"irs_test.php\"'>";
			$pptfolder=$file_directory."IRS\\exam_ppt\\".$LessonID."\\".$NowExam_NO."\\".$y."_".$m."_".$d."/";

			$pptpath = $pptfolder.$nowtime.".".$ext;
			//$pptpath="C:\\wamp\\www\\exam_ppt\\51\\118\\2014_10_07/1412703264.ppt";
			$zyx  = "exam_ppt/".$LessonID."/".$NowExam_NO."address.txt";
			$qq=fopen($zyx,'w');
			fwrite($qq,$object_path."\r\n");
			fclose($qq);
			$tttaa  = "exam_ppt/".$LessonID."/".$NowExam_NO."aassa.txt";
			
			$ww=fopen($tttaa,'w');
			fwrite($ww,$img_fold_for_ir_test."\r\n");
			$imgfolder=$file_directory."IRS\\exam_ppt\\".$LessonID."\\".$NowExam_NO."\\".$y . "_".$m. "_".$d;
			fclose($ww);
			echo "投影片已成功儲存成".$pptpath."<br>";
			echo "投影片已成功儲存至".$imgfolder;
			

			//-----------------------開始分解
			
			$app = new COM("PowerPoint.application") or die("Unable to instantiate PowerPoint");
			$app->Quit();
			$app = null;
			$app = new COM("PowerPoint.application") or die("Unable to instantiate PowerPoint");
			$app->Visible = true;
			$app->Presentations->Open($pptpath); 
			$app->Presentations[1]->SaveAs($imgfolder,18);
			$app->Presentations[1]->Close();
			$app->Quit();
			$app = null;	
			//---------------------------搜尋資料夾內有多少檔案
			$FileDir=$imgfolder; 
			$FileNum=count(glob("$FileDir/*.*"));
			echo "<br>總共有".($FileNum-1)."張投影片";
			$totaljpg=($FileNum-1);
			$alljpg = "exam_ppt/".$LessonID."/".$NowExam_NO."alljpg.txt";
			$alljpgresult=fopen($alljpg,'w');
			fwrite($alljpgresult,$totaljpg."\r\n");	
			fclose($alljpgresult);
			//-------------------寫入學生作答
			$UserDBSQL="SELECT idnumber FROM (
SELECT ra.userid as bb FROM mdl_role_assignments ra WHERE ra.roleid = 5 AND ra.contextid IN (SELECT ctx.id FROM mdl_context ctx WHERE ctx.instanceid ='$id')
) as a,mdl_user WHERE mdl_user.id=a.bb";
			$UserDBResult = mysqli_query($newconni,$UserDBSQL);
			$pgii=0;//
			 while($UserEchoResult = mysqli_fetch_row($UserDBResult))
			{
				while($pgii<($totaljpg+1))
					{	
					
						$local="exam_ppt/".$LessonID."/".$NowExam_NO."/".$pgii."_".$UserEchoResult[0].".txt";
						$qoqoqo=fopen($local,'w');
						fwrite($qoqoqo,'n');
						$pgii++;
					}
				$pgii=0;
			}
			
		

			
		}
		else
		{		
			echo "上傳失敗";
			echo "<input type='button' value='重新上傳' onclick='location.href=\"irs_add.php?id='$id'\"'>";
		}
	}
	else
	{
		echo "你上傳的檔案非ppx或pptx";
		echo "<input type='button' value='重新上傳' onclick='location.href=\"irs_add.php?id='$id'\"'>";
	}
}
else
{
	echo "請填寫考試名稱!";
}
?>
<html>
<body>
<br>
<input type='button' value='返回' onclick='location.href="index_teacher.php?id=<?php echo $id;?>" '>
</body>
</html>