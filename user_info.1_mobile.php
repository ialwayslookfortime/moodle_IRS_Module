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

$colname_RecordsetUsers = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_RecordsetUsers = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysql_select_db($database_pes_conn, $pes_conn);
$query_RecordsetUsers = sprintf("SELECT * FROM vw_students_and_lessons WHERE user_id = %s LIMIT 1", GetSQLValueString($colname_RecordsetUsers, "text"));
$RecordsetUsers = mysql_query($query_RecordsetUsers, $pes_conn) or die(mysql_error());
$row_RecordsetUsers = mysql_fetch_assoc($RecordsetUsers);
$totalRows_RecordsetUsers = mysql_num_rows($RecordsetUsers);
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
			<?php do { ?>
				<table cellspacing="1" class="common_table" style="width:450px;">
					<tr valign="baseline">
						<th colspan="2" align="right" nowrap="nowrap"><strong>個人資料</strong></th>
					</tr>
					<tr valign="baseline">
						<th nowrap="nowrap" align="right">姓名：</th>
						<td><?php echo $row_RecordsetUsers['user_name']; ?> <?php echo pes_group_name(); ?></td>
					</tr>
					<tr valign="baseline">
						<th nowrap="nowrap" align="right">電子郵件：</th>
						<td><a href="mailto:<?php echo $row_RecordsetUsers['user_email']; ?>"><?php echo $row_RecordsetUsers['user_email']; ?></a></td>
					</tr>
					
					<tr valign="baseline">
						<th nowrap="nowrap" align="right">即時通訊：</th>
						<td><?php echo $row_RecordsetUsers['user_msn']; ?></td>
					</tr>
					<tr valign="baseline">
						<th nowrap="nowrap" align="right">相片：</th>
						<td>
							<?php if ($totalRows_RecordsetUserPhoto > 0) { // Show if recordset not empty ?>
								<img src="user_photo_body.php?user_id=<?php echo $_SESSION['MM_Username']; ?>" alt="<?php echo $row_RecordsetUsers['user_name']; ?>的相片" width="<?php echo ($row_RecordsetUserPhoto['photo_width'] > 200) ? 200 : $row_RecordsetUserPhoto['photo_width'] ?>" />
								<?php } // Show if recordset not empty ?>
						</td>
					</tr>
					<tr valign="baseline">
						<th nowrap="nowrap" align="right">註冊時間：</th>
						<td><?php echo $row_RecordsetUsers['create_time']; ?></td>
					</tr>
					<tr valign="baseline">
						<th nowrap="nowrap" align="right">登入位址：</th>
						<td><?php echo $row_RecordsetUsers['login_last_ip']; ?></td>
					</tr>
					<tr valign="baseline">
						<th nowrap="nowrap" align="right">登入時間：</th>
						<td><?php echo $row_RecordsetUsers['login_last_time']; ?></td>
					</tr>
					<tr valign="baseline">
						<th nowrap="nowrap" align="right">登入次數：</th>
						<td><?php echo $row_RecordsetUsers['login_times']; ?></td>
					</tr>
					<tr valign="baseline">
						<th nowrap="nowrap" align="right">&nbsp;</th>
						<td>
							<input type="button" value="編輯個人資料" onclick="location.href='user_edit.1.php';" />
							<input type="button" value="取消" onclick="location.href='home.<?php echo $_SESSION['MM_UserGroup']; ?>.php';" />
						</td>
					</tr>
				</table>
				<?php } while ($row_RecordsetUsers = mysql_fetch_assoc($RecordsetUsers)); ?>
			<!-- InstanceEndEditable --></td>
	</tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RecordsetUsers);

mysql_free_result($RecordsetUserPhoto);
?>
