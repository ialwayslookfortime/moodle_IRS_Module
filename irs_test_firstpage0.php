<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>倒數開始囉</title>
	<?php
	$Now_No=$_GET["qno"];
	?>
	<script>
	var countdownnumber=3;
	var countdownid;
	function init(){ 
		countdown();
		PlaySound();
	}
	function countdown(){
		var x=document.getElementById("countdown");
		x.innerHTML=countdownnumber;
		if (countdownnumber==0){ 
			x.innerHTML = "開始";
			clearTimeout(countdownid);
			document.location.href="http://140.127.220.105/IRS/irs_test_firstpage.php?qno="+<?php echo $Now_No;?>;
		}else{
			countdownnumber--;
			if(countdownid){
				clearTimeout(countdownid);
			}
			countdownid=setTimeout(countdown,1000);
		}
	}
	function PlaySound()
	{	//ran=Math.floor(Math.random() * (3 - 1 + 1)) + 1;	
		//ransound='a'+ran+'.mp3';
		document.getElementById("sounds").innerHTML = "<audio controls autoplay>  <source src='sequence3.mp3' type='audio/mpeg'></audio>"
	}
	</script>
	<style type='text/css'>
		.box{
			position:relative;
		}
		#countdown{
			position:absolute;
			font-family:Microsoft JhengHei;
			top:50%;
			left:35%;
		}
		body{
			background-color: #FDD7E1;
		}
	</style>
</head>
<body onload="init()">
	<div class="box">
		<div id="head" style="font-size:50px;">倒數完後開始搶答</div>
		<div id="countdown" class="num" style="font-size:200px;"></div>
	</div>
	<div id="sounds" style="display:none"></div>
</body>
</html>