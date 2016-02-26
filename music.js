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
	document.getElementById("Nowtime").value=TimeSet;
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
		document.getElementById("Nowtime").value=TimeSet;
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
					document.getElementById("Nowtime").value=TimeSet;
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
			if(TimeSet<=17&&MChange==0)
			{
				PlaySoundQuickly();
				MChange=1;
			}
			document.getElementById("clock").innerHTML=TimeSet;
			document.getElementById("Nowtime").value=TimeSet;
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