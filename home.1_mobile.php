<?php require_once('Connections/pes_conn.php'); ?>
<?php require_once('inc.auth.1234.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=0.8" />
	<title>Peer Evaluation System 同儕評量系統</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<script language="javascript" src="inc.script.js"></script>
</head>
<style>
.myButton {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #3d34ed), color-stop(1, #019ad2));
	background:-moz-linear-gradient(top, #3d34ed 5%, #019ad2 100%);
	background:-webkit-linear-gradient(top, #3d34ed 5%, #019ad2 100%);
	background:-o-linear-gradient(top, #3d34ed 5%, #019ad2 100%);
	background:-ms-linear-gradient(top, #3d34ed 5%, #019ad2 100%);
	background:linear-gradient(to bottom, #3d34ed 5%, #019ad2 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3d34ed', endColorstr='#019ad2',GradientType=0);
	background-color:#3d34ed;
	-moz-border-radius:42px;
	-webkit-border-radius:42px;
	border-radius:42px;
	border:2px solid #067bcf;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Trebuchet MS;
	font-size:28px;
	padding:32px 76px;
	text-decoration:none;
	text-shadow:1px 2px 2px #785b5b;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #019ad2), color-stop(1, #3d34ed));
	background:-moz-linear-gradient(top, #019ad2 5%, #3d34ed 100%);
	background:-webkit-linear-gradient(top, #019ad2 5%, #3d34ed 100%);
	background:-o-linear-gradient(top, #019ad2 5%, #3d34ed 100%);
	background:-ms-linear-gradient(top, #019ad2 5%, #3d34ed 100%);
	background:linear-gradient(to bottom, #019ad2 5%, #3d34ed 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#019ad2', endColorstr='#3d34ed',GradientType=0);
	background-color:#019ad2;
}
.myButton:active {
	position:relative;
	top:1px;
}
</style>
<body style="background-color:#FFD8AF;">
<div align='center' style='margin-top:30%;font-size:15%;'>
	<input type="button" class="myButton" onclick="location.href='user_info.1_mobile.php'" 	 value="個人資料管理" />
</div><br><br><div align='center'>				
	<input type="button" class="myButton" onclick="location.href='lesson_info.1_mobile.php'" value="課程資料檢視" />
</div><br><br><div align='center'>
	<input type="button" class="myButton" onclick="location.href='logout.php'" 		 value="登出帳號" />
</div>	
</body>

</html>
