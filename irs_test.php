<?php 
	//  Display the course home page.
	//session_start();
	require_once('connection/connection.php');
	require_once('../config.php');
	require_once('../newconfig.php');
	require_once($CFG->dirroot.'../mod/resource/locallib.php');
	
	$id   		 = optional_param('id', 0, PARAM_INT); //courseid
	/*
    $catid       = optional_param('catid', 0, PARAM_INT);
    $uid         = optional_param('uid', 0, PARAM_INT);
    $id   		 = optional_param('id', 0, PARAM_INT); //courseid
    $name        = optional_param('name', '', PARAM_RAW);
	*/
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
//-------------將課程ID以及Exam_all切開為考試編號以及考試名稱


if(isset($_POST['Exam_ALL']))
{
	$Exam_ALL=$_POST['Exam_ALL'];
}
$postdata= preg_split("/_zaybxc_/",$Exam_ALL);//切開post的資料
$Exam_NO=$postdata[0];//考試編號
//$_SESSION['Exam_NO']=$Exam_NO;
$Exam_Name=$postdata[1];//考試名稱
//$_SESSION['Exam_Name']=$Exam_Name;

//echo $_SESSION['Exam_Name']."~";
//$SESSION->test='4444444';
//$id=$postdata[2];
//$_SESSION['LessonID']=$id;
$LessonID=$id;
echo "examno=".$Exam_NO;
$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
require_login($course);
//print_r($USER);
//---------------------讀出jpg位置
echo "id=".$LessonID; 
$zyx  = "exam_ppt/".$LessonID."/".$Exam_NO."aassa.txt";
$qoqo=fopen($zyx,'r');			
$png_Address=fgets($qoqo,256);
fclose($qoqo);
//echo $png_Address."<br>";


//---------------------讀出總頁數

$totalpage  = "exam_ppt/".$LessonID."/".$Exam_NO."alljpg.txt";
$totalpagefile=fopen($totalpage,'r');			
$Total_Page=fgets($totalpagefile,256);
fclose($totalpagefile);
//$_SESSION['Total_Page']=$Total_Page;//要傳給download
//echo $Total_Page;
 

//--------------------偵測考場是否關閉

$ExamOpenSQL="SELECT opening  FROM irs_lesson WHERE lesson_id='$LessonID' AND exam_no='$Exam_NO' ";
$ExamOpenQuery=mysqli_query($newconni,$ExamOpenSQL);
$ExamOpenResult=mysqli_fetch_row($ExamOpenQuery);
//echo $ExamOpenResult[0];


?>
<script src="question_no.js"></script> 
<script src="irs_test_to_openans.js"></script> 
<script src="irs_test_reset.js"></script> 
<script src="exportcsvajax.js"></script> 
<script src="deletepeople.js"></script>


<script>
function gotodownload()
{
	var id="<?php echo $id;?>";
	var examno="<?php echo $Exam_NO;?>";
	var TotalPage=<?php echo $Total_Page;?>;
	var examname="<?php echo $Exam_Name;?>";
	window.open('irs_test_exportcsv.php?id='+id+'&examno='+examno+'&TotalPage='+TotalPage+'&examname='+examname ,'Chart', fullscreen='yes');
}
</script> 



<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>-->
<html>
<head>
<link rel="stylesheet" type="text/css" href="timetochange_main.css">
</head>
<title>IRS_TEST</title>
<body>
<nav><h4 align="left" ><?php echo "考試名稱 : ".$Exam_Name;?></h4></nav>
<?php 
$pagenum = '1';
$ppttoimg = $png_Address;
$ppttoimg = trim($ppttoimg);
//$_SESSION['$ppttoimg']=$ppttoimg;
//-------------------------------------------
//總頁數

$ht=(int)$Total_Page;//-------------------------------------------
if(1==1)
{	
//echo "<iframe id='iframeppt' onchange='changepage()' src='"/exam_ppt/296/2014.09.25/1.png"' style='width:85%; height:85%;margin-top:3%' frameborder='0'></iframe>";
echo "<img id='iframeppt' src='".$ppttoimg."Slide1.png'>";
	#if($LessonID==53)
		#{
		#	echo "<iframe id='studentonline' src='guest_online.php' frameborder='0'></iframe>";
		#}
	#else
	#	{
			echo "<iframe id='studentonline' src='student_online.php?id=".$id."&examno=".$Exam_NO."' frameborder='0'></iframe>";
	#	}
}

//$before_url=$_SESSION['before_url'];
?>
<aside class = left>
	<div>
		<?php 
			
			echo "<div id='ExamArea'><form id='OKLetsExam' name='OKLetsExam' action='irs_test.php' method='POST' value='1' ><input type='image' img src='' name='OKLetsExam' value='開啟考場' ></input></form>
			 <form id='OKExitExam' name='OKExitExam' action='irs_test.php' method='POST' value='0'><input type='image' img src='' name='OKExitExam' value='關閉考場' ></input></form>";
		
		?>
		<h4 class="reset_1" ><a href="#" onclick='reset_ajax(getnumfromphp,<?php echo $id;?>,<?php echo $Exam_NO;?>)'><img src="image/reset_1.png"></a><!--<input id="reset"  type="image" img src="image/reset_1.png"  onclick='reset_ajax(getnumfromphp)'/>--></h4>
		<h4 align="left" ><input id="PES" type="image" img src="image/PES_pink.png"  onclick='location.href="<?php echo $before_url;?>" '></h4>
		
		</div>
		<!--題數區域-->
		<div id='PageArea'>
			<h5 align="left" ><?php echo "總頁數 :".$ht;?></h5>
			<h5 align="left" id='NowNUM'>目前頁數：<?php echo $pagenum;?></h5>
			<input type='image' id='previouschangepage' img src="image/preview.png" value="上一頁" onclick="previouschangepage()">
			<input type='image' id='nextchangepage'img src="image/next.png" value="下一頁" onclick="nextchangepage()"><br>
			<input type="number" method='POST' id='pagenumber' name='pagenumber'  value='<?php echo $pagenum ;?>' >
			<input type='button' id='changepage' value="GO"  onclick="changepage()">
			<br>
			
		</div>
		
		<!--計時區域-->
		<div id='TimeArea'>
			<input type="image" img src="image/play.png" value="START" onclick="StartClick()">
			<input type="image" img src="image/pause.png" value="PAUSE" onclick="PauseClick()">
			<input type="image" img src="image/stop.png" value="STOP!" onclick="StopClick()"><br>
			<div  align="center" id="clock" ></div>
			<div id="selection">
				時間：
				<select id="Extratime" >
					<option value='10'>10</option>	
					<option selected="true" value='15'>15</option>	
					<option value='20'>20</option>	
					<option value='25'>25</option>	
					<option value='30'>30</option>	
					<option value='35'>35</option>	
					<option value='40'>40</option>
				</select>秒
				<input  id="checkextra" value="延長" type="image" img src=""  onclick="Extratime()"/>
			</div>
			<input  id="gogochart" value="分析圖表" type="image" img src=""  onclick="ChartPage()"/>
			<!--<input  id="volunteer" value="搶答" type="image" img src=""  onclick="FirstPage()"/>-->
			<input  id="exportcsv" value="匯出" type="button" img src="" onclick="gotodownload()"/><!--exportcsvajax() -->
		</div>
		<div  id="show_areaaa"></div>

		
		<div id="sounds" style="display:none"></div>
	</div>
</aside>

</body>
</html>






































<?php
	if(isset($_POST['OKLetsExam']))
	{
		$openingornotSQL="update irs_lesson set opening='0' where exam_no='$Exam_NO' ";
		$openingornotSQLQuery = mysqli_query($newconni,$openingornotSQL);
		$openingornotSQLFirstDelete="update irs_lesson set opening='1' where exam_no='$Exam_NO' ";
		$openingornotSQLFirstDeleteQuery = mysqli_query($newconni,$openingornotSQLFirstDelete);
		//刪除考場內人數
		$delete="delete from irs_online_statues where lesson_id='$LessonID'";
		$deleteresult = mysqli_query($newconni,$delete);
		//新增考場人數
		//$UserDBSQL="select user_id from pes_students_lessons where lesson_id='$LessonID' AND user_validated='1'  order by user_id asc";
		$UserDBSQL="SELECT idnumber,username FROM (
SELECT ra.userid as bb FROM mdl_role_assignments ra WHERE ra.roleid = 5 AND ra.contextid IN (SELECT ctx.id FROM mdl_context ctx WHERE ctx.instanceid ='$id')
) as a,mdl_user WHERE mdl_user.id=a.bb";
		$UserDBResult = mysqli_query($newconni,$UserDBSQL);
		$i=0;		
		while($UserEchoResult = mysqli_fetch_row($UserDBResult))
		{
				$titleUserID=$UserEchoResult[0];
				$titleUserNAME=$UserEchoResult[1];
				$InsertIRSSQL="insert into irs_online_statues(user_id,user_name,lesson_id) 
				values ('$titleUserID','$titleUserNAME','$LessonID')";
				$InsertIRSQuery = mysqli_query($newconni,$InsertIRSSQL);
		}	
		
	}
	
	if(isset($_POST['OKExitExam']))
	{
		$ExitopeningornotSQL="update irs_lesson set opening='0' where exam_no='$Exam_NO' ";
		$ExitopeningornotSQLQuery = mysqli_query($newconni,$ExitopeningornotSQL);
		//刪除考場內人數
		$Exitdelete="delete from irs_online_statues where lesson_id='$LessonID'";
		$Exitdeleteresult = mysqli_query($newconni,$Exitdelete);
		
		//刪除考試題數
		$NOdelete="delete from irs_online_exam_no where Lesson_ID='$LessonID'";
		$NOdeleteresult = mysqli_query($newconni,$NOdelete);
	}
	
?>
<script>
question_no(-1,'<?php echo $id;?>','<?php echo $Exam_NO;?>');//預設用
var getnumfromphp = "<?php echo $pagenum ;?>"
var checkpage = "<?php echo $pagenum ;?>"
document.getElementById('pagenumber').value = "<?php echo $pagenum; ?>"
var max = "<?php echo $ht; ?>";
function changepage()//於pagenumber2填入當前頁數,之後才顯示於src=allpage
{
	checkpage = document.getElementById('pagenumber').value ;
	checkpage = parseInt(checkpage);
	var max_int = parseInt(max);
	if( (checkpage <= max_int)  &&  (checkpage>0)) 
	{
		getnumfromphp = document.getElementById('pagenumber').value;
		var int_getnumfromphp = parseInt(getnumfromphp)
		var str_getnumfromphp = int_getnumfromphp.toString();
		var pagesrc = "<?php echo $ppttoimg; ?>";
		pagesrc = pagesrc +'Slide'+str_getnumfromphp+'.png';
		document.getElementById("iframeppt").src=pagesrc;
		document.getElementById("NowNUM").innerHTML="<?php echo "目前頁數：";?>"+getnumfromphp;
		
		var pag_to_int=parseInt(getnumfromphp)
		pag_to_int=pag_to_int-1
		
		question_no(pag_to_int,'<?php echo $id;?>','<?php echo $Exam_NO;?>')
		open_to_ans('0','<?php echo $id;?>','<?php echo $Exam_NO?>');//0=關
		//reset_ajax(checkpage)//2015/3/16 新增按下一頁自動創txt
		StopClick()
	}
	else
	{
		alert ("頁數超過範圍");
		open_to_ans('0','<?php echo $id;?>','<?php echo $Exam_NO?>');//0=關
		StopClick()
	}
	
}
function nextchangepage()
{
	var int_getnumfromphp = parseInt(getnumfromphp);
	var str_getnumfromphp = int_getnumfromphp.toString();
	if((int_getnumfromphp+1)<=max)
	{
		
		getnumfromphp = int_getnumfromphp +1 ;
		int_getnumfromphp = parseInt(getnumfromphp)
		str_getnumfromphp = int_getnumfromphp.toString()
		var pagesrc = "<?php echo $ppttoimg; ?>"
		pagesrc = pagesrc +'Slide'+str_getnumfromphp+'.png';
		document.getElementById("iframeppt").src=pagesrc;
		document.getElementById("NowNUM").innerHTML="<?php echo "目前頁數：";?>"+getnumfromphp;
		document.getElementById('pagenumber').value = int_getnumfromphp
		
		var pag_to_int=parseInt(getnumfromphp)
		pag_to_int=pag_to_int-1
		
		question_no(pag_to_int,'<?php echo $id;?>','<?php echo $Exam_NO;?>')
		//reset_ajax(int_getnumfromphp+1)//2015/3/16 新增按下一頁自動創txt
		open_to_ans('0','<?php echo $id;?>','<?php echo $Exam_NO?>');//0=關
		StopClick()
	}
	else
	{
		alert ("已經是最後一頁了");
		open_to_ans('0','<?php echo $id;?>','<?php echo $Exam_NO?>');//0=關
		StopClick()
	}
}
function previouschangepage()
{
	if(!(getnumfromphp-1)<1)
	{
		var int_getnumfromphp = parseInt(getnumfromphp)
		var str_getnumfromphp = int_getnumfromphp.toString();
		getnumfromphp = int_getnumfromphp -1;
		int_getnumfromphp = parseInt(getnumfromphp)
		str_getnumfromphp = int_getnumfromphp.toString()
		var pagesrc = "<?php echo $ppttoimg; ?>"
		pagesrc = pagesrc +'Slide'+str_getnumfromphp+'.png';
		document.getElementById("iframeppt").src=pagesrc;
		document.getElementById("NowNUM").innerHTML="<?php echo "目前頁數：";?>"+getnumfromphp;
		document.getElementById('pagenumber').value = int_getnumfromphp
		
		var pag_to_int=parseInt(getnumfromphp)
		pag_to_int=pag_to_int-1
		
		question_no(pag_to_int,'<?php echo $id;?>','<?php echo $Exam_NO;?>')
		open_to_ans('0','<?php echo $id;?>','<?php echo $Exam_NO?>');//0=關
		StopClick()
	}
	else
	{
		alert ("已經是第一頁了");
		open_to_ans('0','<?php echo $id;?>','<?php echo $Exam_NO?>');//0=關
		StopClick()
	}
}
function ChartPage()
{
	var id="<?php echo $id;?>";
	var examno="<?php echo $Exam_NO;?>";
	var ppttoimg="<?php echo $ppttoimg;?>";
//window.open('irs_test_chart.php?qno='+getnumfromphp, 'Chart', fullscreen='yes');
window.open('irs_test_chart.php?qno='+getnumfromphp+'&id='+id+'&examno='+examno+'&ppttoimg='+ppttoimg , 'Chart', fullscreen='yes');
}

</script>
<script>
	var TimeSet=0;
	var Starting=0;
	var NowCounterLaunch;
	var ExtraOrNot=0;
	var PauseTime=0;
	var StopAction=0;
	var MChange=0;
	var StartC=0;
	var bran=0;
	function PlaySound()
	{	ran=Math.floor(Math.random() * (6 - 1 + 1)) + 1;	
		ransound='a'+ran+'.mp3';
		document.getElementById("sounds").innerHTML = "<audio controls autoplay>  <source src='"+ransound+"' type='audio/mpeg'></audio>"
	}
	function PlaySoundQuickly()
	{	
		bran=Math.floor(Math.random() * (5 - 1 + 1)) + 1;
		bransound='b'+bran+'.mp3';
		document.getElementById("sounds").innerHTML = "<audio controls autoplay>  <source src='"+bransound+"' type='audio/mpeg'></audio>"
	}
	function StopSound()
	{
		document.getElementById("sounds").innerHTML = "";
	}
	function MusicChange()
	{
		PlaySound()
	}
	function StartClick()
	{	
		if(Starting==0&&StartC==0)
		{
			 NowCounterLaunch = setInterval("CounterLaunch()",1000);
			 StartC=1;
		}
	}
	function PauseClick()
	{
		StopSound()
		open_to_ans('0','<?php echo $id;?>','<?php echo $Exam_NO?>');//0=關
		clearInterval(NowCounterLaunch);
		document.getElementById("clock").innerHTML="時間已於"+(TimeSet+1)+"秒暫停";
		Starting=0;
		PauseTime=TimeSet;
		MChange=0;
		StartC=0;
	}
	function StopClick()
	{
		StopSound()
		open_to_ans('0','<?php echo $id;?>','<?php echo $Exam_NO?>');//0=關
		clearInterval(NowCounterLaunch);
		document.getElementById("clock").innerHTML="時間已於"+(TimeSet+1)+"秒停止";
		Starting=0;
		StopAction=1;
		MChange=0;
		StartC=0;
		
	}
	function CounterLaunch()
	{
		var TimeSetOrNot = document.getElementById("Extratime").value;
		if(TimeSetOrNot!=0&&Starting==0)
		{
			if(PauseTime!=0)
			{	
				open_to_ans('1','<?php echo $id;?>','<?php echo $Exam_NO?>');//1=開
				TimeSet=PauseTime;
				PauseTime=0;
				Starting=1;
				MusicChange();
			}
			else
			{
				open_to_ans('1','<?php echo $id;?>','<?php echo $Exam_NO?>');//1=開
				TimeSet=TimeSetOrNot;
				Starting=1;
				MusicChange();
			}
			
		}
		else if(TimeSetOrNot==0&&Starting==0)
		{
			if(PauseTime!=0)
			{	
				open_to_ans('1','<?php echo $id;?>','<?php echo $Exam_NO?>');//1=開
				TimeSet=PauseTime;
				PauseTime=0;
				Starting=1;
				MusicChange();
			}
			else
			{	
				open_to_ans('1','<?php echo $id;?>','<?php echo $Exam_NO?>');//1=開
				TimeSet=10;
				Starting=1;
				MusicChange();
			}
		}
		
		if(TimeSet==-1)
		{
			StopSound()
			open_to_ans('0','<?php echo $id;?>','<?php echo $Exam_NO?>');//0=關
			document.getElementById("clock").innerHTML="時間到";
			clearInterval(NowCounterLaunch);
			Starting=0;
			MChange=0;
			StartC=0;
		}
		else
		{
			if(ExtraOrNot==1)
			{
					if(PauseTime==0)
					{
						document.getElementById("clock").innerHTML=TimeSet+"<br>"+"(延長"+TimeSetOrNot+"秒)";
						TimeSet--;
						if(TimeSet<=6&&MChange==0)
						{
							PlaySoundQuickly();
							MChange=1;
						}
					}
					else
					{

						document.getElementById("clock").innerHTML=TimeSet;
						TimeSet--;
						if(TimeSet<=6&&MChange==0)
						{
							PlaySoundQuickly();
							MChange=1;
						}
					}
			}
			else
			{			
				if(TimeSet<=6&&MChange==0)
				{
					PlaySoundQuickly();
					MChange=1;
				}
				document.getElementById("clock").innerHTML=TimeSet;
				TimeSet--;
			}
		}
	}
	function Extratime()
	{
		if(PauseTime==0&&Starting==1)
		{
			var TimeSetOrNot = document.getElementById("Extratime").value;
			TimeSet = parseInt(TimeSet)+parseInt(TimeSetOrNot);
			ExtraOrNot=1;
		}
	}
function FirstPage()
{
//setTimeout(delete_to_ans, 2000);
window.open('irs_test_firstpage0.php?qno='+getnumfromphp, 'Chart', fullscreen='yes');
open_to_ans('1','<?php echo $id;?>','<?php echo $Exam_NO?>');//開啟視窗可回答
//StartClick();
}
//reset_ajax(getnumfromphp);//預設用
</script>
