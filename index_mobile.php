<?php require_once("connection/connection.php"); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// 將登入帳號轉為大寫
if (isset($_POST['user_id'])) {
	$_POST['user_id'] = mb_strtoupper($_POST['user_id']);
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['user_id'])) {
  $loginUsername=$_POST['user_id'];
  $password=$_POST['user_pw'];
  $MM_fldUserAuthorization = "user_group";
  $MM_redirectLoginSuccess = "login_step2.php";
  $MM_redirectLoginFailed = "login_fail.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_pes_conn, $pes_conn);
  	
  $LoginRS__query=sprintf("SELECT user_id, user_pw, user_group FROM vw_users_students WHERE user_id=%s AND user_pw=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $pes_conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'user_group');
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      
    $_SESSION['MM_UserId']=$loginUsername;//新增
    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8;"/>
<meta name="viewport" content="width=device-width, initial-scale=0.8" />
<title>Peer Evaluation System 同儕評量系統</title>
<script language="javascript" src="inc.script.js"></script>
<script language="javascript">
	window.onload = function(){
		window.document.getElementById('user_id').focus();
	};
</script>
</head>
<body>
<h1 align='center'>PES/IRS手機登入系統</h1><br>
<form action="<?php echo $loginFormAction; ?>" method="POST" name="form1" id="form1" onsubmit="YY_checkform('form1','user_id','#q','0','請輸入您的帳號','user_pw','#q','0','請輸入您的密碼');return document.MM_returnValue">
<font size='150%'>帳號：</font>
<input style="padding:5%;font-size:20px" name="user_id" type="text" id="user_id" SIZE='10' />
<font size='150%' color="#FF0000" }>*</font><br/><br>
<font size='150%'>密碼：</font>
<input style="padding:5%;font-size:20px" name="user_pw" type="password" id="user_pw" SIZE='10' />
<font size='150%' color="#FF0000">*</font><br/><br><br>
<div align='center'><input style="font-size:50px" type="submit" name="Submit" value="登入帳號" /></div><br>
<div align='center'><input style="font-size:50px" type="button" value="取消x" onclick="location.href='index.php';" /></div>
</form>
</body>
</html>