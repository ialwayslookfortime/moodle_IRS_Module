<?php require_once('Connections/pes_conn.php'); ?>
<?php require_once('inc.auth.1234.php'); ?>
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

if ((isset($_GET['lesson_id'])) && ($_GET['lesson_id'] != "")) {
  $updateSQL = sprintf("UPDATE pes_students_lessons SET user_quit = 1, quit_time=%s WHERE lesson_id=%s AND user_id=%s AND user_quit=0",
                       GetSQLValueString("", "date"),
					   GetSQLValueString($_GET['lesson_id'], "int"),
					   GetSQLValueString($_SESSION['MM_Username'], "text"));

  mysql_select_db($database_pes_conn, $pes_conn);
  $Result1 = mysql_query($updateSQL, $pes_conn) or die(mysql_error());

  $updateGoTo = "lesson_info.1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>棄選上課中課程</title>
</head>
<body>
</body>
</html>
