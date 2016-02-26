<?php session_start() ;?>
<?php require_once("connection/connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>quickly</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="irs_test_firstpage.css">
	<script type='text/javascript' src='sequence_to_ans.js'></script>
    <!--<script type='text/javascript' src='deletepeople.js'></script>-->
	<!--<script type='text/javascript' src='irs_test_to_openans.js'></script> -->
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
	var viewname=0;//1為啟動 顯示人名
	function PlaySound()
	{	//ran=Math.floor(Math.random() * (3 - 1 + 1)) + 1;	
		//ransound='a'+ran+'.mp3';
		document.getElementById("sounds").innerHTML = "<audio controls autoplay>  <source src='sequence3.mp3' type='audio/mpeg'></audio>"
	}
	function PlaySoundQuickly()
	{	
		//bran=Math.floor(Math.random() * (15 - 1 + 1)) + 1;
		//bransound='b'+bran+'.mp3';
		document.getElementById("sounds").innerHTML = "<audio controls autoplay>  <source src='sequenceb.mp3' type='audio/mpeg'></audio>"
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
		//open_to_ans('0');//0=關
		clearInterval(NowCounterLaunch);
		document.getElementById("clock").innerHTML=""+(TimeSet+1)+"";
		Starting=0;
		PauseTime=TimeSet;
		MChange=0;
		StartC=0;
	}
	function StopClick()
	{
		StopSound()
		//open_to_ans('0');//0=關
		clearInterval(NowCounterLaunch);
		document.getElementById("clock").innerHTML=""+(TimeSet+1)+"";
		
		Starting=0;
		StopAction=1;
		MChange=0;
		StartC=0;
		
	}
	function CounterLaunch()
	{
		//var TimeSetOrNot = document.getElementById("Extratime").value;
		var TimeSetOrNot = 20;
		if(TimeSetOrNot!=0&&Starting==0)
		{
			if(PauseTime!=0)
			{	
				//open_to_ans('1');//1=開
				TimeSet=PauseTime;
				PauseTime=0;
				Starting=1;
				MusicChange();
			}
			else
			{
				//open_to_ans('1');//1=開
				TimeSet=TimeSetOrNot;
				Starting=1;
				MusicChange();
			}
			
		}
		else if(TimeSetOrNot==0&&Starting==0)
		{
			if(PauseTime!=0)
			{	
				//open_to_ans('1');//1=開
				TimeSet=PauseTime;
				PauseTime=0;
				Starting=1;
				MusicChange();
			}
			else
			{	
				//open_to_ans('1');//1=開
				TimeSet=10;
				Starting=1;
				MusicChange();
			}
		}
		
		if(TimeSet==-1)
		{
			StopSound()
			//open_to_ans('0');//0=關
			document.getElementById("clock").innerHTML="timeout";
			
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
				if(TimeSet<=20&&MChange==0)
				{
					PlaySoundQuickly();
					MChange=1;
					if(viewname==0)
					{
						//delete_to_ans();
						init();
						//console.log(Student_id.length,Last_arr_length)
						setInterval("DynamicInsertStudent()", 2000);
						viewname=1;					
					}
				}
				if(TimeSet>17)
				{
					
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
	
	</script>
	<script>
	StartClick();
	</script>
	<?php
	
	$LessonID= $_SESSION['lesson_id'];
	$Now_No=$_GET["qno"];
	$n=$Now_No-1;
	$Exam_NO=$_SESSION['Exam_NO'];
	$SQL="DELETE FROM irs_ans_sequence WHERE LessonID='$LessonID'";
	mysqli_query($irs_conni,$SQL);
	?>
	<script>
	var LessonID=<?php echo $LessonID;?>;
	var n=<?php echo $n;?>;
	var Exam_NO=<?php echo $Exam_NO;?>;
	</script>
</head>
<body >
    <div  align="center" id="clock" style="font-size:200px;"></div>
	<form action="" method="post">
	<input type="text" name="rester" value="1" style="display:none">
	<input type="submit" value="Reset">
	</form>
	<div id='TimeArea'>
			<input type="image" img src="image/play.png" value="START" width="8%" height="12%" onclick="StartClick()">
			<input type="image" img src="image/pause.png" value="PAUSE" width="8%" height="12%" onclick="PauseClick()">
			<input type="image" img src="image/stop.png" value="STOP!" width="8%" height="12%" onclick="StopClick()"><br>
	</div>
	<div id="box"></div>
	<?php
	if(isset($_POST['rester']))
	{
		$ifreset=$_POST['rester'];
	}
	if($ifreset==1)
	{
		echo $Lesson_ID;
		$SQL="DELETE FROM irs_ans_sequence WHERE LessonID='$LessonID'";
		mysqli_query($irs_conni,$SQL);
		$ifreset=0;
	}

	?>

	<!--<?php
	
	/*if($i>11)$i=11;//設定最多人數
	for($j=0;$j<$i;$j++)
	{
		echo "<script>var j=".$j."</script>";
		echo "<script>var Student_id='".$Student_id[$j]."'</script>";
		echo $name[$j].$Student_id[$j]."<input type='checkbox' id='box".$Student_id[$j]."' name='".$Student_id[$j]."' value='go' onclick='sequence_to_ans(LessonID,n,Exam_NO,j,Student_id)'> <div id='num_".$j."' style='
		display:inline;'><div>";
		//echo $name[$j].$Student_id[$j]."<input type='checkbox' id='box".$Student_id[$j]."' name='".$Student_id[$j]."' value='go' onclick='box_click".$j."'> <div id='num_".$j."'><div>";

	}*/
	?>-->
	<script type="text/javascript">
		var Student_name = new Array();
		var Student_id = new Array();
		var Student_time = new Array();
		var Sum_text="";
		var Last_arr_length = 0;
		function SquenceNameSearch(){
			var xhr = new XMLHttpRequest;
			Student_name.length = 0;
			Student_id.length = 0;
			Student_time.length= 0;
				xhr.onreadystatechange = function(){
					var res = xhr.responseText;
					//console.log(res)
					res = res.split("+");
					if(res.length>1){

						for (var i = 0 ;i<res.length ; i++)
						{
							res[i]=res[i].trim();
							if (i%3 === 0 )
							{
								Student_name.push(res[i]);
							}
							else if(i%3 === 1 )
								Student_id.push(res[i]);
							else if(i%3 === 2 )
								Student_time.push(res[i]);
						}
					}
					/*for (var i = 0 ;i<res.length ; i++){
						if (i%2 == 0 )
							name.push(res[i]);
						else 
							Student_id.push(res[i]);
					}*/
				}
				xhr.open("GET","./sequence_search_ans.php",false);
				xhr.send(null);
				
		}
		function init(){
			SquenceNameSearch();
			Student_name.length = Student_id.length; //清除學生名字陣列長度多一
			for( var i = 0; i < Student_id.length; i++){
				var t = document.createElement("p");
    			//t.innerHTML = Student_name[i]+Student_id[i]+"<input type='checkbox' id='box"+Student_id[i]+"' name='"+Student_id[i]+"' value='go' onclick='sequence_to_ans("+LessonID+","+n+","+Exam_NO+","+i+",\""+Student_id[i]+"\")'><span id='num_"+i+"'></span>";
				t.innerHTML = "<input type='checkbox' id='box"+Student_id[i]+"' name='"+Student_id[i]+"' value='go' onclick='sequence_to_ans("+LessonID+","+n+","+Exam_NO+","+i+",\""+Student_id[i]+"\")'><label for='box"+Student_id[i]+"'>"+Student_name[i]+Student_id[i]+"---"+Student_time[i]+"</label><span class='answer' id='num_"+i+"'></span>";
				//var text = "<p>"+Student_name[i]+Student_id[i]+"<input type='checkbox' id='box"+Student_id[i]+"' name='"+Student_id[i]+"' value='go' onclick='sequence_to_ans("+LessonID+","+n+","+Exam_NO+","+i+",\""+Student_id[i]+"\")'><span id='num_"+i+"'></span></p>";
				//Sum_text = Sum_text+text;
				document.getElementById("box").appendChild(t);
			}
			//console.log(Student_id.length,Last_arr_length);
			Last_arr_length = Student_id.length;
		}

		function DynamicInsertStudent(){
			SquenceNameSearch();
			Student_name.length = Student_id.length; //清除學生名字陣列長度多一
			if(Last_arr_length < Student_id.length){ //代表有新學生進入
				for( var i = Last_arr_length; i < Student_id.length; i++){
					//var text = "<p>"+Student_name[i]+Student_id[i]+"<input type='checkbox' id='box"+Student_id[i]+"' name='"+Student_id[i]+"' value='go' onclick='sequence_to_ans("+LessonID+","+n+","+Exam_NO+","+i+",\""+Student_id[i]+"\")'><span id='num_"+i+"'></span></p>";
					//Sum_text = Sum_text+text;
					var t = document.createElement("p");
    				//t.innerHTML = Student_name[i]+Student_id[i]+"<input type='checkbox' id='box"+Student_id[i]+"' name='"+Student_id[i]+"' value='go' onclick='sequence_to_ans("+LessonID+","+n+","+Exam_NO+","+i+",\""+Student_id[i]+"\")'><label for='"+Student_id[i]+"'>"+Student_name[i]+Student_id[i]+"</label><span id='num_"+i+"'></span>";
    				t.innerHTML = "<input type='checkbox' id='box"+Student_id[i]+"' name='"+Student_id[i]+"' value='go' onclick='sequence_to_ans("+LessonID+","+n+","+Exam_NO+","+i+",\""+Student_id[i]+"\")'><label for='box"+Student_id[i]+"'>"+Student_name[i]+Student_id[i]+"---"+Student_time[i]+"</label><span class='answer' id='num_"+i+"'></span>";
					document.getElementById("box").appendChild(t);
				}
			}
			Last_arr_length = Student_id.length;
		}

		
		
		//init();
		//console.log(Student_id.length,Last_arr_length)
		//setInterval("DynamicInsertStudent()", 2000);
	
		
	</script>
	<div id="sounds" style="display:none"></div>
	
</body>
</html>



