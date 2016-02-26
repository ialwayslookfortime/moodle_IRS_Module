<script>
function AnswerSelect(type)
	  {
		var a = document.getElementById("studentansa");
		var b = document.getElementById("studentansb");
		var c = document.getElementById("studentansc");
		var d = document.getElementById("studentansd");
		var e = document.getElementById("studentanse");
		var f  = document.getElementById("studentansf");
		var n = document.getElementById("studentansn");
		var v = document.getElementById("studentansv");
		var z = document.getElementById("studentansz");
		switch (v.value)
		{
			default	:
				a.style.display = "none";
				b.style.display = "none";
				c.style.display = "none";
				d.style.display = "none";
				e.style.display = "none";
				n.style.display	= "table-row";
				break;
			case "1" :
				n.style.display = "none";
				b.style.display = "none";
				c.style.display = "none";
				d.style.display = "none";
				e.style.display = "none";
				a.style.display = "table-row";
				break;
			case "2" :
				a.style.display = "none";
				n.style.display = "none";
				c.style.display = "none";
				d.style.display = "none";
				e.style.display = "none";
				b.style.display = "table-row";
				break;
			case "3" :
				a.style.display = "none";
				b.style.display = "none";
				n.style.display = "none";
				d.style.display = "none";
				e.style.display = "none";
				c.style.display	= "table-row";
				break;
			case "4" :
				a.style.display = "none";
				b.style.display = "none";
				c.style.display = "none";
				n.style.display = "none";
				e.style.display = "none";
				d.style.display = "table-row";
				break;
			case "5" :
				n.style.display = "none";
				b.style.display = "none";
				c.style.display = "none";
				d.style.display = "none";
				a.style.display = "none";
				e.style.display	= "table-row";
				break;
			case "6" :
				a.style.display = "none";
				b.style.display = "none";
				c.style.display = "none";
				d.style.display = "none";
				e.style.display = "none";
				n.style.display = "table-row";
				break;			
			case "7" :
				a.style.display = "none";
				b.style.display = "none";
				c.style.display = "none";
				d.style.display = "none";
				e.style.display = "none";
				n.style.display = "none";
				z.style.display = "table-row";
				break;
			case "8" :
				a.style.display = "none";
				b.style.display = "none";
				c.style.display = "none";
				d.style.display = "none";
				e.style.display = "none";
				n.style.display = "none";
				f.style.display = "table-row";
				break;				
		}
	  }
</script>
<?php require_once('connection/connection.php'); ?>
<?php
require_once('../config.php');
require_once('../newconfig.php');
require_once($CFG->dirroot.'../mod/resource/locallib.php');
$id   = optional_param('id', 0, PARAM_INT); //courseid
$examno = optional_param('examno', 0, PARAM_INT); //examno   
//$ppttoimg = optional_param('ppttoimg', 0, PARAM_INT); //ppttoimg  
$ppttoimg=$_GET['ppttoimg'];
//echo $ppttoimg;
$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
require_login($course);	
	//$ppttoimg=$_SESSION['$ppttoimg'];
	$Exam_NO=$examno;	
	$LessonID=$id;

$pgii=0;
$ansa=0;
$ansb=0;
$ansc=0;
$ansd=0;
$anse=0;
$ansf=0;
$ansz=0;
$ansF=0;//答案F
$noppt=$_GET['qno'];
$n=$_GET['qno'];
$n=$n-1;
$onlineornotSQL = "SELECT * FROM irs_online_statues WHERE lesson_id='$LessonID' "; 
$onlineornotQuery = mysqli_query($newconni,$onlineornotSQL);

$a=array();
$b=array();
$c=array();
$d=array();
$e=array();
$f=array();
$z=array();
$fff=array();//答案F
$da=date("Y-m-d H:i:s");

//$n=1;//控制要查看哪題
 /*$UserDBSQL="select user_id from pes_students_lessons where lesson_id='22'  order by user_id asc";
 $UserDBResult = mysqli_query($pes_conni,$UserDBSQL);*/
 $i=0;
 while($OnlineStudent = mysqli_fetch_row($onlineornotQuery))
 {
	
		    $userid=$OnlineStudent[1];
			$username=$OnlineStudent[2];			
			$local="./exam_ppt/".$LessonID."/".$Exam_NO."/".$n."_".$userid.".txt";
			@$qoqoqo=fopen($local,'r');
			@$mydata=fgets($qoqoqo,256);
			@fclose($qoqoqo);
			if( $mydata=='a' && (strtotime($da)-strtotime($OnlineStudent[4])<600)){$ansa++;$a[]=$username;}
			if( $mydata=='b' && (strtotime($da)-strtotime($OnlineStudent[4])<600)){$ansb++;$b[]=$username;}
			if( $mydata=='c' && (strtotime($da)-strtotime($OnlineStudent[4])<600)){$ansc++;$c[]=$username;}
			if( $mydata=='d' && (strtotime($da)-strtotime($OnlineStudent[4])<600)){$ansd++;$d[]=$username;}
			if( $mydata=='e' && (strtotime($da)-strtotime($OnlineStudent[4])<600)){$anse++;$e[]=$username;}
			if( $mydata=='n' && (strtotime($da)-strtotime($OnlineStudent[4])<600)){$ansf++;$f[]=$username;}
			if( $mydata=='z' && (strtotime($da)-strtotime($OnlineStudent[4])<600)){$ansz++;$z[]=$username;}
			if( $mydata=='f' && (strtotime($da)-strtotime($OnlineStudent[4])<600)){$ansF++;$fff[]=$username;}//答案F
			//echo "學生".$username."第".$pgii."題回答:".$mydata."</br>";
			$i++;
 }
/*echo "第".$n."題回答[ A ]的有".$ansa."人</br>";
echo "第".$n."題回答[ B ]的有".$ansb."人</br>";
echo "第".$n."題回答[ C ]的有".$ansc."人</br>";
echo "第".$n."題回答[ D ]的有".$ansd."人</br>";
echo "第".$n."題回答[ E ]的有".$anse."人</br>";
echo "第".$n."題沒有回答的有".$ansf."人</br>";*/
//echo "總共人數".($ansa+$ansb+$ansc+$ansd+$anse+$ansf);
//echo "總人數".$i;
?>
<html>
 <head>
    <!--<script type="text/javascript" src="https://www.google.com/jsapi"></script>-->
    <script type="text/javascript" src="./jsapi.js"></script>
	
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() 
	  {

        var data = google.visualization.arrayToDataTable
		([
          ['', ''],
          ['A',<?php echo $ansa;?>],
          ['B',<?php echo $ansb;?>],
          ['C',<?php echo $ansc;?>],
          ['D',<?php echo $ansd;?>],
          ['E',<?php echo $anse;?>],
		  ['F',<?php echo $ansF;?>],
		  ['N',<?php echo $ansf;?>],
		  ['Hesitating',<?php echo $ansz;?>],
		]);

        var options = 
		{
          title: 'No.'+<?php echo $n; ?>+' Answer Result '
        };
		var view = new google.visualization.DataView(data);
		view.setColumns([0, 1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" }]);
        var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));
        chart.draw(view, options);
    }
	  
    </script>
  </head>
  <body>
  
   <div id="ppt"><img  src="<?php echo $ppttoimg."/Slide".$noppt;?>.png" style='width:50%; height:70%;align:left;z-index:11;'></div>
   <div id="piechart" style="width: 70%; height: 70%;align:right;margin-top:-35%;margin-left:45%;align:right;z-index:11;"></div>
<div id="displaystudentansbutton" style="text-align:0; margin:auto;margin-top:200px;">
	各答案填題者：
			<select id="studentansv" style="width: 5%;height:4%;text-align:0; margin:auto;padding-left: 10px;" onchange="AnswerSelect()" >
				<option value="1">A</option>
				<option value="2">B</option>
				<option value="3">C</option>
				<option value="4">D</option>
				<option value="5">E</option>
				<option value="8">F</option>
				<option value="7">Z</option>
				<option selected="true" value="6">N</option>
			</select>
</div>
<div style='margin-top:3%;z-index:10;position:absolute;'>
	<div id="studentansa" style="display:none;">
			<?php 
				echo "總共".$ansa."人";
				if($ansa>0)
				{
					echo "<table border='1'>";
					echo "<tr>";
				}
				for($ai=1;$ai<($ansa+1);$ai++)
				{
					if($a[$ai-1]!="")
					{
						echo "<td>".$a[$ai-1]."</td>";
					}
						
					if($ai%15==0&&$ai>0)
					{
						echo "</tr><tr>";
					}
				}
				if($ansa>0)
				{
					echo "</tr></table>";
				}
			?>

	</div>
	<div id="studentansb" style="display:none;">
			<?php 
				echo "總共".$ansb."人";
				if($ansb>0)
				{
					echo "<table border='1'>";
					echo "<tr>";
				}

				for($bi=1;$bi<($ansb+1);$bi++)
				{
					if($b[$bi-1]!="")
					{
						echo "<td>".$b[$bi-1]."</td>";
					}
						
					if($bi%15==0&&$bi>0)
					{
						echo "</tr><tr>";
					}
				}
				if($ansb>0)
				{
					echo "</tr></table>";
				}
			?>

	</div>
	<div id="studentansc" style="display:none;">
			<?php 
				echo "總共".$ansc."人";
				if($ansc>0)
				{
					echo "<table border='1'>";
					echo "<tr>";
				}

				for($ci=1;$ci<($ansc+1);$ci++)
				{
					if($c[$ci-1]!="")
					{
						echo "<td>".$c[$ci-1]."</td>";
					}
						
					if($ci%15==0&&$ci>0)
					{
						echo "</tr><tr>";
					}
				}
				if($ansc>0)
				{
					echo "</tr></table>";
				}
			?>

	</div>
	<div id="studentansd" style="display:none;">
			<?php 
				echo "總共".$ansd."人";
				if($ansd>0)
				{
					echo "<table border='1'>";
					echo "<tr>";
				}

				for($di=1;$di<($ansd+1);$di++)
				{
					if($d[$di-1]!="")
					{
						echo "<td>".$d[$di-1]."</td>";
					}
						
					if($di%15==0&&$di>0)
					{
						echo "</tr><tr>";
					}
				}
				if($ansd>0)
				{
					echo "</tr></table>";
				}
			?>

	</div>
	<div id="studentanse" style="display:none;">
			<?php 
				echo "總共".$anse."人";
				if($anse>0)
				{
					echo "<table border='1'>";
					echo "<tr>";
				}

				for($ei=1;$ei<($anse+1);$ei++)
				{
					if($e[$ei-1]!="")
					{
						echo "<td>".$e[$ei-1]."</td>";
					}
						
					if($ei%15==0&&$ei>0)
					{
						echo "</tr><tr>";
					}
				}
				if($anse>0)
				{
					echo "</tr></table>";
				}

			?>

	</div>
	<div id="studentansn" style="display:none;">
			<?php 
				echo "總共".$ansf."人";
				if($ansf>0)
				{
					echo "<table border='1'>";
					echo "<tr>";
				}
				for($fi=1;$fi<($ansf+1);$fi++)
				{
					if($f[$fi-1]!="")
					{
						echo "<td>".$f[$fi-1]."</td>";
					}
					if($fi%15==0&&$fi>0)
					{
						echo "</tr><tr>";
					}
				}
				if($ansf>0)
				{
					echo "</tr></table>";
				}
			?>
	</div>
		<div id="studentansz" style="display:none;">
			<?php 
				echo "總共".$ansz."人";
				if($ansz>0)
				{
					echo "<table border='1'>";
					echo "<tr>";
				}
				for($zi=1;$zi<($ansz+1);$zi++)
				{
					if($z[$zi-1]!="")
					{
						echo "<td>".$z[$zi-1]."</td>";
					}
					if($zi%15==0&&$zi>0)
					{
						echo "</tr><tr>";
					}
				}
				if($ansz>0)
				{
					echo "</tr></table>";
				}
			?>
	</div>
		<div id="studentansf" style="display:none;"><!--答案F-->
			<?php 
				echo "總共".$ansF."人";
				if($ansF>0)
				{
					echo "<table border='1'>";
					echo "<tr>";
				}
				for($FFi=1;$FFi<($ansF+1);$FFi++)
				{
					if($fff[$FFi-1]!="")
					{
						echo "<td>".$fff[$FFi-1]."</td>";
					}
					if($FFi%15==0&&$FFi>0)
					{
						echo "</tr><tr>";
					}
				}
				if($ansF>0)
				{
					echo "</tr></table>";
				}
			?>
	</div>
</div>
  </body>
</html>
