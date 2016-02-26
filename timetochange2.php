<?php 
session_start() ;
require_once("connection/connection.php");

//-------------將課程ID以及Exam_all切開為考試編號以及考試名稱

$LessonID= $_SESSION['lesson_id'];
if(isset($_POST['Exam_ALL']))
{
	$_SESSION['Exam_ALL']=$_POST['Exam_ALL'];
}
$postdata= preg_split("/_zaybxc_/",$_SESSION['Exam_ALL']);//切開post的資料
$Exam_NO=$postdata[0];//考試編號
$_SESSION['Exam_NO']=$Exam_NO;
$Exam_Name=$postdata[1];//考試名稱

//---------------------讀出jpg位置

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
//echo $Total_Page;

//--------------------偵測考場是否關閉

$ExamOpenSQL="SELECT opening  FROM irs_lesson WHERE lesson_id='$LessonID' AND exam_no='$Exam_NO' ";
$ExamOpenQuery=mysqli_query($irs_conni,$ExamOpenSQL);
$ExamOpenResult=mysqli_fetch_row($ExamOpenQuery);
//echo $ExamOpenResult[0];


?>
<script src="question_no.js"></script> 
<script src="irs_test_to_openans.js"></script> 
<script src="irs_test_reset.js"></script> 




























<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>-->
<html>

<head>
<link rel="stylesheet" type="text/css" href="timetochange_main2.css">

</head>
<title>IRS_TEST</title>

<body>
<nav></nav>
<?php 

$pagenum = '1';

$ppttoimg = $png_Address;
$ppttoimg = trim($ppttoimg);
$_SESSION['$ppttoimg']=$ppttoimg;
//-------------------------------------------
//總頁數

$ht=(int)$Total_Page;//-------------------------------------------
if($_SESSION['MM_UserGroup']==3)
{	
//echo "<iframe id='iframeppt' onchange='changepage()' src='"/exam_ppt/296/2014.09.25/1.png"' style='width:85%; height:85%;margin-top:3%' frameborder='0'></iframe>";
echo "<img id='iframeppt' src='".$ppttoimg."Slide1.png'>";
echo "<iframe id='studentonline' src='student_online2.php' frameborder='0'></iframe>";
}

$before_url=$_SESSION['before_url'];
?>
<aside class = left>
	<div>
		<?php 
		if($_SESSION['MM_UserGroup']==3)
		{	
			echo "<div id='ExamArea'><form id='OKLetsExam' name='OKLetsExam' action='irs_test.php' method='POST' value='1' ><input type='image' img src='' name='OKLetsExam' value='開啟考場' ></input></form>
			 <form id='OKExitExam' name='OKExitExam' action='irs_test.php' method='POST' value='0'><input type='image' img src='' name='OKExitExam' value='關閉考場' ></input></form>";
		}
		?>
		<h4><input id="reset" value="一鍵清除" type="image" img src="image/reset_blue.png"   onclick="reset_ajax(getnumfromphp)"/><br></h4>
		<h4 align="left" ><input type='button' value='回到PES' onclick='location.href="<?php echo $before_url;?>" '></h4>
		<h4 align="left" ><?php echo "考試名稱 : ".$Exam_Name;?></h4>
		</div>
		<!--題數區域-->
		
		<div id='PageArea'>
			<h5 align="left" ><?php echo "總頁數 :".$ht;?></h5>
			<h5 align="left" id='NowNUM'>目前頁數：<?php echo $pagenum;?></h5>
			<input type="number" method='POST' id='pagenumber' name='pagenumber'  value='<?php echo $pagenum ;?>' >
			<input type='button' id='changepage' value="GO"  onclick="changepage()">
			<br>
			<input type='image' id='previouschangepage' img src="image/preview_blue.png" value="上一頁" onclick="previouschangepage()">
			<input type='image' id='nextchangepage'img src="image/next_blue.png" value="下一頁" onclick="nextchangepage()"><br>
			
		</div>
		
		<!--計時區域-->
		<div id='TimeArea'>
			<input type="image" img src="image/play_blue.png" value="START" onclick="StartClick()">
			<input type="image" img src="image/pause_blue.png" value="PAUSE" onclick="PauseClick()">
			<input type="image" img src="image/stop_blue.png" value="STOP!" onclick="StopClick()"><br>
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
			<input id="volunteer" value="搶答者" type="image" img src=""  onclick="FirstPage()"/>
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
		$openingornotSQLQuery = mysqli_query($irs_conni,$openingornotSQL);
		$openingornotSQLFirstDelete="update irs_lesson set opening='1' where exam_no='$Exam_NO' ";
		$openingornotSQLFirstDeleteQuery = mysqli_query($irs_conni,$openingornotSQLFirstDelete);
		//刪除考場內人數
		$delete="delete from irs_online_statues where lesson_id='$LessonID'";
		$deleteresult = mysqli_query($irs_conni,$delete);
		//新增考場人數
		$UserDBSQL="select user_id from pes_students_lessons where lesson_id='$LessonID' AND user_validated='1'  order by user_id asc";
		$UserDBResult = mysqli_query($pes_conni,$UserDBSQL);
		$i=0;		
		while($UserEchoResult = mysqli_fetch_row($UserDBResult))
		{
				$titleUserID=$UserEchoResult[0];
				$UserNameDBSQL="select user_name from pes_students where user_id='$UserEchoResult[0]'";
				$UserNameDBResult = mysqli_query($pes_conni,$UserNameDBSQL);
				$UserNameEchoResult = mysqli_fetch_row($UserNameDBResult);
				$i++;	
				$InsertIRSSQL="insert into irs_online_statues(user_id,user_name,lesson_id) 
				values ('$UserEchoResult[0]','$UserNameEchoResult[0]','$LessonID')";
				$InsertIRSQuery = mysqli_query($irs_conni,$InsertIRSSQL);
		}	
		
	}
	if(isset($_POST['OKExitExam']))
	{
		$ExitopeningornotSQL="update irs_lesson set opening='0' where exam_no='$Exam_NO' ";
		$ExitopeningornotSQLQuery = mysqli_query($irs_conni,$ExitopeningornotSQL);
		//刪除考場內人數
		$Exitdelete="delete from irs_online_statues where lesson_id='$LessonID'";
		$Exitdeleteresult = mysqli_query($irs_conni,$Exitdelete);
		
		//刪除考試題數
		$NOdelete="delete from irs_online_exam_no where Lesson_ID='$LessonID'";
		$NOdeleteresult = mysqli_query($irs_conni,$NOdelete);
	}
	
?>
<script>
question_no(-1);//預設用
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
		
		question_no(pag_to_int)
		open_to_ans('0');//0=關
		//reset_ajax(checkpage)//2015/3/16 新增按下一頁自動創txt
		StopClick()
	}
	else
	{
		alert ("頁數超過範圍");
		open_to_ans('0');//0=關
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
		
		question_no(pag_to_int)
		//reset_ajax(int_getnumfromphp+1)//2015/3/16 新增按下一頁自動創txt
		open_to_ans('0');//0=關
		StopClick()
	}
	else
	{
		alert ("已經是最後一頁了");
		open_to_ans('0');//0=關
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
		
		question_no(pag_to_int)
		open_to_ans('0');//0=關
		StopClick()
	}
	else
	{
		alert ("已經是第一頁了");
		open_to_ans('0');//0=關
		StopClick()
	}
}
function ChartPage()
{

window.open('irs_test_chart.php?qno='+getnumfromphp, 'Chart', fullscreen='yes');
}
function FirstPage()
{

window.open('irs_test_firstpage.php?qno='+getnumfromphp, 'Chart', fullscreen='yes');
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
	{	ran=Math.floor(Math.random() * (4 - 1 + 1)) + 1;	
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
		open_to_ans('0');//0=關
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
		open_to_ans('0');//0=關
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
				open_to_ans('1');//1=開
				TimeSet=PauseTime;
				PauseTime=0;
				Starting=1;
				MusicChange();
			}
			else
			{
				open_to_ans('1');//1=開
				TimeSet=TimeSetOrNot;
				Starting=1;
				MusicChange();
			}
			
		}
		else if(TimeSetOrNot==0&&Starting==0)
		{
			if(PauseTime!=0)
			{	
				open_to_ans('1');//1=開
				TimeSet=PauseTime;
				PauseTime=0;
				Starting=1;
				MusicChange();
			}
			else
			{	
				open_to_ans('1');//1=開
				TimeSet=10;
				Starting=1;
				MusicChange();
			}
		}
		
		if(TimeSet==-1)
		{
			StopSound()
			open_to_ans('0');//0=關
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
//reset_ajax(getnumfromphp);//預設用
</script>
