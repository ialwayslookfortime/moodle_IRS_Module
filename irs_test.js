question_no(0);
var getnumfromphp = "<?php echo $pagenum ;?>"
var checkpage = "<?php echo $pagenum ;?>"
document.getElementById('pagenumber').value = "<?php echo $pagenum; ?>"
var max = "<?php echo $Total_Page; ?>";
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
		var pagesrc = "<?php echo $Jpg_Address; ?>";//$Jpg_Address."/Slide1.png
		pagesrc = pagesrc +'/Slide'+str_getnumfromphp+'.png';
		document.getElementById("iframeppt").src=pagesrc;
		document.getElementById("NowNUM").innerHTML="<?php echo "目前頁數：";?>"+getnumfromphp;
		question_no(getnumfromphp-1)
	}
	else
	{
		alert ("頁數超過範圍");
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
		var pagesrc = "<?php echo $Jpg_Address; ?>"
		pagesrc = pagesrc +'/Slide'+ str_getnumfromphp+'.png';
		document.getElementById("iframeppt").src=pagesrc;
		document.getElementById("NowNUM").innerHTML="<?php echo "目前頁數：";?>"+getnumfromphp;
		question_no(getnumfromphp-1)
		document.getElementById('pagenumber').value = int_getnumfromphp
	}
	else
	{
		alert ("已經是最後一頁了");
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
		var pagesrc = "<?php echo $Jpg_Address; ?>"
		pagesrc = pagesrc +'/Slide'+ str_getnumfromphp+'.png';
		document.getElementById("iframeppt").src=pagesrc;
		document.getElementById("NowNUM").innerHTML="<?php echo "目前頁數：";?>"+getnumfromphp;
		question_no(getnumfromphp-1)
		document.getElementById('pagenumber').value = int_getnumfromphp
	}
	else
	{
		alert ("已經是第一頁了");
	}
}
function ChartPage()
{

window.open('irs_test_chart.php?qno='+getnumfromphp, 'Chart', fullscreen='yes');
}
	var TimeSet=0;
	var Starting=0;
	var NowCounterLaunch;
	var ExtraOrNot=0;
	var PauseTime=0;
	var StopAction=0;
	var MChange=0;
	var StartC=0;
	function PlaySound()
	{
		document.getElementById("sounds").innerHTML = "<audio controls autoplay>  <source src='a.mp3' type='audio/mpeg'></audio>"
	}
	function PlaySoundQuickly()
	{
		document.getElementById("sounds").innerHTML = "<audio controls autoplay>  <source src='b.mp3' type='audio/mpeg'></audio>"
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
		close_to_ans();
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
		close_to_ans();
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
				open_to_ans();
				TimeSet=PauseTime;
				PauseTime=0;
				Starting=1;
				MusicChange();
			}
			else
			{
				open_to_ans();
				TimeSet=TimeSetOrNot;
				Starting=1;
				MusicChange();
			}
			
		}
		else if(TimeSetOrNot==0&&Starting==0)
		{
			if(PauseTime!=0)
			{	
				open_to_ans();
				TimeSet=PauseTime;
				PauseTime=0;
				Starting=1;
				MusicChange();
			}
			else
			{	
				open_to_ans();
				TimeSet=10;
				Starting=1;
				MusicChange();
			}
		}
		
		if(TimeSet==-1)
		{
			StopSound()
			close_to_ans();
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
					}
					else
					{

						document.getElementById("clock").innerHTML=TimeSet;
						TimeSet--;
					}
			}
			else
			{			
				if(TimeSet<=5&&MChange==0)
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
