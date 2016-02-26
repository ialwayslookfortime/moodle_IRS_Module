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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE pes_students SET user_pw=%s, user_name=%s, user_email=%s, user_msn=%s, user_face=%s WHERE user_id=%s",
                       GetSQLValueString($_POST['user_pw'], "text"),
                       GetSQLValueString($_POST['user_name'], "text"),
                       GetSQLValueString($_POST['user_email'], "text"),
                       GetSQLValueString($_POST['user_msn'], "text"),
                       GetSQLValueString($_POST['user_face'], "text"),
                       GetSQLValueString($_POST['user_id'], "text"));

  mysql_select_db($database_pes_conn, $pes_conn);
  $Result1 = mysql_query($updateSQL, $pes_conn) or die(mysql_error());

  $updateGoTo = "user_info.1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysql_select_db($database_pes_conn, $pes_conn);
$query_Recordset1 = sprintf("SELECT * FROM pes_students WHERE user_id = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $pes_conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php
$colname_RecordsetUserPhoto = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_RecordsetUserPhoto = $_SESSION['MM_Username'];
}
mysql_select_db($database_pes_conn, $pes_conn);
$query_RecordsetUserPhoto = sprintf("SELECT * FROM pes_user_photo WHERE user_id = %s", GetSQLValueString($colname_RecordsetUserPhoto, "text"));
$RecordsetUserPhoto = mysql_query($query_RecordsetUserPhoto, $pes_conn) or die(mysql_error());
$row_RecordsetUserPhoto = mysql_fetch_assoc($RecordsetUserPhoto);
$totalRows_RecordsetUserPhoto = mysql_num_rows($RecordsetUserPhoto);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.8" />
<title>Peer Evaluation System 同儕評量系統</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="inc.script.js"></script>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
	<tr valign="top">
		<td colspan="2"><!-- InstanceBeginEditable name="body" -->
			<form action="<?php echo $editFormAction; ?>" method="post" name="form1" onsubmit="YY_checkform('form1','user_name','#q','0','請輸入您的姓名','user_email','S','2','請輸入您的郵件','user_pw','#q','0','請輸入您的密碼','user_pw2','#user_pw','6','密碼不相符');return document.MM_returnValue">
				<table cellspacing="1" class="common_table" style="width:450px;">
					<tr valign="baseline">
						<th colspan="2" align="right" nowrap="nowrap"><strong>編輯個人資料</strong></th>
					</tr>
					<tr valign="baseline">
						<th nowrap align="right">帳號：</th>
						<td><?php echo $row_Recordset1['user_id']; ?></td>
					</tr>
					<tr valign="baseline">
						<th nowrap align="right">密碼：</th>
						<td>
							<input type="password" name="user_pw" value="<?php echo $row_Recordset1['user_pw']; ?>" size="32">
							<font color="#FF0000">*</font> </td>
					</tr>
					<tr valign="baseline">
						<th nowrap align="right">確認密碼：</th>
						<td>
							<input type="password" name="user_pw2" value="<?php echo $row_Recordset1['user_pw']; ?>" size="32" />
							<font color="#FF0000">*</font></td>
					</tr>
					<tr valign="baseline">
						<th nowrap align="right">姓名：</th>
						<td>
							<input type="text" name="user_name" value="<?php echo $row_Recordset1['user_name']; ?>" size="32">
							<font color="#FF0000">*</font> </td>
					</tr>
					<tr valign="baseline">
						<th nowrap align="right">電子郵件：</th>
						<td>
							<input type="text" name="user_email" value="<?php echo $row_Recordset1['user_email']; ?>" size="32">
							<font color="#FF0000">*</font> </td>
					</tr>
					<tr valign="baseline">
						<th nowrap align="right">即時通訊：</th>
						<td>
							<input name="user_msn" type="text" id="user_msn" value="<?php echo $row_Recordset1['user_msn']; ?>" size="32" />
							<br />
							(MSN or Yahoo!) </td>
					</tr>
					<tr valign="baseline">
						<th nowrap align="right">相片：</th>
						<td>
							<input type="text" name="user_face" value="<?php echo $row_Recordset1['user_face']; ?>" size="32">
							<br />
							(本欄已廢除，請使用下方超連結管理相片)<br />
							<?php if ($totalRows_RecordsetUserPhoto > 0) { // Show if recordset not empty ?>
								<img src="user_photo_body.php?user_id=<?php echo $_SESSION['MM_Username']; ?>" alt="<?php echo $row_Recordset1['user_name']; ?>的相片" width="<?php echo ($row_RecordsetUserPhoto['photo_width'] > 200) ? 200 : $row_RecordsetUserPhoto['photo_width'] ?>" />
								<?php } // Show if recordset not empty ?>
							<br />
							<a href="user_photo.php?url=user_edit.1.php">上傳我的相片</a> | <a href="user_photo_drop.php?url=user_edit.1.php">刪除我的相片</a></td>
					</tr>
					<tr valign="baseline">
						<th nowrap align="right">&nbsp;</th>
						<td>
							<input type="submit" value="更新" onclick="return submit_confirm();">
							<input type="button" value="取消" onclick="location.href='user_info.1.php';" />
						</td>
					</tr>
				</table>
				<input type="hidden" name="MM_update" value="form1">
				<input type="hidden" name="user_id" value="<?php echo $row_Recordset1['user_id']; ?>">
			</form>
			<!-- InstanceEndEditable --></td>
	</tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($RecordsetUserPhoto);
?>
