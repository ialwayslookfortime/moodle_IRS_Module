<?php //session_start() ;?>
<?php 
require_once('connection/connection.php'); 
require_once('../config.php');
require_once('../newconfig.php');
require_once($CFG->dirroot.'../mod/resource/locallib.php');


$da=date("Y-m-d H:i:s");
if(isset($_POST['Exam_ALL']))
{
	$_SESSION['Exam_ALL']=$_POST['Exam_ALL'];
}
$postdata= preg_split("/_zaybxc_/",$_SESSION['Exam_ALL']);//切開post的資料
$Exam_NO=$postdata[0];//考試編號
$_SESSION['Exam_NO']=$Exam_NO;
$Exam_Name=$postdata[1];//考試名稱
$LessonID= $postdata[2];
$id=$LessonID;
//echo $LessonID;
$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
require_login($course);
//print_r($USER);
$guestname=$USER->username;
$studentid=$USER->idnumber;
//echo $Exam_NO;
echo "<h1>".$guestname."</h1>";
echo "<h1>您目前使用的學號：".$studentid."</h1>";
?>
<script src="answer.js"></script> 
<?php
/*
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
header('Location: student_answer_mobile.php');
*/
$SQLTIMEexist="Select * from irs_online_statues where user_id='$studentid'";
$QueryTIMEexist=mysqli_query($newconni,$SQLTIMEexist);
$resultTIMEexist=mysqli_fetch_row($QueryTIMEexist);

if($resultTIMEexist[0]==null)
{
	$SQLTIME="INSERT INTO irs_online_statues(user_id,user_name,lesson_id,date) VALUES('$studentid','$guestname','$LessonID','$da')";	
	mysqli_query($newconni,$SQLTIME);
}
?>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title></title>
<!-- 引入 jQuery(非必要,去掉時有些寫法要改為javascript) -->
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>-->
<!-- 引入AJAX(必要) -->

<script type="text/javascript" src="student_timeout.js"></script> 
<script type="text/javascript">
//examno_ajax('')//抓取目前題數
time_ajax('<?php  echo $id;?>')//存取時間
</script>
</head>
<body>
<!--<div>以ajax實現頁面不刷新,從前端將值傳送到後端處理,並且回傳給前端顯示</div>-->
<!--<div  id="show_area"></div>-->
<div id ="anss" 
style="
margin-left:10%;
margin-top:5%;
position: fixed;
width: 75%;
clear: both;
height: 75%;
text-align:center;" 
>
<input id='sequenceans' type="image" img src="Letters/sequence.jpg" value="O" width="16%" height="25%" onclick="ans('o','<?php echo $id;?>','<?php echo $Exam_NO;?>')"></br>
<input id='ansa' type="image" img src="Letters/a.jpg" value="A" width="16%" height="25%" onclick="ans('a','<?php echo $id;?>','<?php echo $Exam_NO;?>')">
<input id='ansb' type="image" img src="Letters/b.jpg" value="B"	width="16%" height="25%" onclick="ans('b','<?php echo $id;?>','<?php echo $Exam_NO;?>')">
<input id='ansc' type="image" img src="Letters/c.jpg" value="C"	width="16%" height="25%" onclick="ans('c','<?php echo $id;?>','<?php echo $Exam_NO;?>')">
<input id='ansd' type="image" img src="Letters/d.jpg" value="D"	width="16%" height="25%" onclick="ans('d','<?php echo $id;?>','<?php echo $Exam_NO;?>')">
<input id='anse' type="image" img src="Letters/e.jpg" value="E"	width="16%" height="25%" onclick="ans('e','<?php echo $id;?>','<?php echo $Exam_NO;?>')">
<input id='ansf' type="image" img src="Letters/f.jpg" value="F"	width="16%" height="25%" onclick="ans('f','<?php echo $id;?>','<?php echo $Exam_NO;?>')">
<input id='ansz' type="image" img src="Letters/zz.jpg" style="margin-top:30px;" value="Z"	width="25%" height="40%" onclick="ans('z','<?php echo $id;?>','<?php echo $Exam_NO;?>')">
<!--
<form action="" method="GET" >
<input type="text" name="ansb" value="b">
<input id='ansa' type="image" img src="/letters/a.jpg" value="a"  name='ansa' width="19%" height="25%" >
<input type="submit" value="送出">
</form>-->
</div>
</body>
<script type="text/javascript">
//examno_ajax('')
</script>
</html>
