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
  $updateSQL = sprintf("UPDATE pes_students_lessons SET lesson_group=%s WHERE lesson_id=%s AND user_id=%s",
                       GetSQLValueString($_POST['lesson_group'], "int"),
                       GetSQLValueString($_POST['lesson_id'], "int"),
					   GetSQLValueString($_POST['user_id'], "text"));

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
<?php
$colname_RecordsetLessons = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_RecordsetLessons = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysql_select_db($database_pes_conn, $pes_conn);
$query_RecordsetLessons = sprintf("SELECT * FROM vw_students_and_lessons WHERE user_id = %s AND lesson_id > 0 ORDER BY lesson_status DESC, lesson_id DESC, lesson_session DESC", GetSQLValueString($colname_RecordsetLessons, "text"));
$RecordsetLessons = mysql_query($query_RecordsetLessons, $pes_conn) or die(mysql_error());
$row_RecordsetLessons = mysql_fetch_assoc($RecordsetLessons);
$totalRows_RecordsetLessons = mysql_num_rows($RecordsetLessons);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8;"/>
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
			<table width="100%" border="0" cellspacing="0" cellpadding="5">
				<tr valign="top">
					<td width="640">
						<table align='center' cellspacing="1" class="common_table" style="width: 100%;margin-top:30%;">							<tr>
								<th width="80" nowrap="nowrap"><strong>授課學期</strong></th>
								<th nowrap="nowrap"><strong>課程名稱</strong></th>
								<th width="110" nowrap="nowrap"><strong>組別</strong></th>
								<th nowrap="nowrap"><strong>驗證</strong></th>
							</tr>
							<?php if ($totalRows_RecordsetLessons > 0) { // Show if recordset not empty ?>
								<?php do { ?>
									<tr valign="top">
										<td nowrap="nowrap"><?php echo $row_RecordsetLessons['lesson_year']; ?>年第<?php echo $row_RecordsetLessons['lesson_session']; ?>學期</td>
										<td nowrap="nowrap">
											<?php if ($row_RecordsetLessons['user_validated'] > 0) { ?>
											<a href="works_mobile.php?lesson_id=<?php echo $row_RecordsetLessons['lesson_id']; ?>">
											<?php } ?>
											<?php echo $row_RecordsetLessons['lesson_name_cht']; ?><br />
											<?php echo $row_RecordsetLessons['lesson_name_eng']; ?>
											<?php if ($row_RecordsetLessons['user_validated'] > 0) { ?>
											</a>
											<?php } ?>
										</td>
										<td nowrap="nowrap">
											<?php
										// 已通過的課程，才能變更組別
										if ($row_RecordsetLessons['user_validated'] == 1) {
										?>
											<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
												<select name="lesson_group">
													<?php
											for ($i = 0; $i < 100; $i++) {
												echo "<option value=\"" . $i . "\" ";
												if (!(strcmp($i , $row_RecordsetLessons['lesson_group']))) {
													echo "selected=\"selected\"";
												}
												echo ">";
												echo ($i == 0) ? "未定" : $i;
												echo "</option>";
											}
											?>
												</select>
												<input type="submit" value="更新" onclick="return submit_confirm();" <?php if ($row_RecordsetLessons['adv_group_change'] == 0) { ?> disabled="disabled" <?php } ?>  />
												<input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_Username']; ?>">
												<input type="hidden" name="MM_update" value="form1">
												<input type="hidden" name="lesson_id" value="<?php echo $row_RecordsetLessons['lesson_id']; ?>">
											</form>
											<?php } else {
											echo "未定";
											}
											?>
										</td>
										<td nowrap="nowrap">
											<?php
											switch ($row_RecordsetLessons['user_validated']) {
												case "-1" :
													echo "未審核";
													break;
												case "0" :
													echo "不通過";
													break;
												case "1" :
													echo "已核準";
													break;
											}
											?>
											<?php if ($row_RecordsetLessons['user_validated'] == -1 || $row_RecordsetLessons['user_validated'] == 0) { ?>
											<a href="javascript:if (confirm('您確定要刪除嗎?')) { self.location.href='student_drop_lesson.php?lesson_id=<?php echo $row_RecordsetLessons['lesson_id']; ?>'; }"><img src="images/13x13_Trashcan.gif" alt="刪除選修課程" width="13" height="13" border="0" /></a>
											<?php } ?>
											<br />
											<?php
											switch ($row_RecordsetLessons['user_quit']) {
												case "0" :
													echo "上課中";
													break;
												case "1" :
													echo "<font color=red>已棄選</font>";
													break;
											}
											?>
											<?php if ($row_RecordsetLessons['user_quit'] == 0) { ?>
											<a href="javascript:if (confirm('您確定要棄選嗎?')) { self.location.href='student_quit_lesson.php?lesson_id=<?php echo $row_RecordsetLessons['lesson_id']; ?>'; }"><img src="images/13x13_Trashcan.gif" alt="棄選上課中課程" width="13" height="13" border="0" /></a>
											<?php } ?>
										</td>
									</tr>
									<?php } while ($row_RecordsetLessons = mysql_fetch_assoc($RecordsetLessons)); ?>
								<?php } // Show if recordset not empty ?>
						</table>
					</td>
					
				</tr>
			</table>
			<!-- InstanceEndEditable --></td>
	</tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RecordsetLessons);
?>
