<?php require_once('Connections/pes_conn.php'); ?>
<?php require_once('inc.auth.1234.php'); ?>
<?php



if ($_SESSION['MM_UserGroup'] == 1) {
	GoToUrlNow("lesson_info.1.php");
}
?>
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
$colname_RecordsetLessons = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_RecordsetLessons = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
$colname1_RecordsetLessons = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname1_RecordsetLessons = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysql_select_db($database_pes_conn, $pes_conn);
$query_RecordsetLessons = sprintf("SELECT * FROM pes_lessons WHERE lesson_user_id = %s OR lesson_user_id2 = %s ORDER BY lesson_year DESC, lesson_session DESC, lesson_status DESC, lesson_id DESC", GetSQLValueString($colname_RecordsetLessons, "text"),GetSQLValueString($colname1_RecordsetLessons, "text"));
$RecordsetLessons = mysql_query($query_RecordsetLessons, $pes_conn) or die(mysql_error());
$row_RecordsetLessons = mysql_fetch_assoc($RecordsetLessons);
$totalRows_RecordsetLessons = mysql_num_rows($RecordsetLessons);
?>
<?php
$colname_RecordsetNews = "-1";
if (isset($lesson_id)) {
  $colname_RecordsetNews = (get_magic_quotes_gpc()) ? $lesson_id : addslashes($lesson_id);
}
mysql_select_db($database_pes_conn, $pes_conn);
$query_RecordsetNews = sprintf("SELECT * FROM pes_news WHERE news_lesson_id = %s ORDER BY news_id DESC", GetSQLValueString($colname_RecordsetNews, "int"));
$RecordsetNews = mysql_query($query_RecordsetNews, $pes_conn) or die(mysql_error());
$row_RecordsetNews = mysql_fetch_assoc($RecordsetNews);
$totalRows_RecordsetNews = mysql_num_rows($RecordsetNews);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=0.8" />
<title>Peer Evaluation System 同儕評量系統</title>
<!--<style>@media only screen and (-webkit-device-pixel-ratio: 2) {}</style>-->
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="inc.script.js"></script>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
	<tr>
		<td nowrap="nowrap" id="main_menu">
			<?php include('inc.menu.php'); ?>
		</td>
		<td align="right" nowrap="nowrap" id="main_menu">
			<?php
			if (!isset($_GET['HideMenu'])) {
				if (isset($_SESSION['MM_Username'])) {
					if ($_SESSION['MM_UserGroup'] == 1){
						$path_parts = pathinfo($_SERVER['SCRIPT_NAME']);
						echo "<span> <a href=\"Documents\\student_guideline\\";
						switch ($path_parts['basename']){
							case "index.php":
								echo "pre_register\S-manual.html";
								break;
							case "user_add.php":
								echo "pre_register\S-add2.html";
								break;
							case "login.php":
								echo "pre_register\login2.html";
								break;
							case "contact.php":
								echo "pre_register\S_contact2.html";
								break;
							case "home.1.php":
								echo "register\userinfo.html";
								break;
							case "user_info.1.php":
								echo "register\user2.html";
								break;
							case "user_edit.1.php":
								echo "register\user3.html";
								break;
							case "lesson_info.1.php":
								echo "register\lesson2.html";
								break;
							case "student_add_lesson.php":
								echo "register\add_lesson2.html";
								break;
							case "works.php":
								echo "register\lesson3.html";
								break;
							default:
								echo "pre_register\S-manual.html";
								break;
						}
						echo "\" target=\"_blank\">操作說明</a> </span>";
					} else if ($_SESSION['MM_UserGroup'] == 3){
						$path_parts = pathinfo($_SERVER['SCRIPT_NAME']);
						echo "<span> <a href=\"teacher\\";
						switch ($path_parts['basename']){
							case "home.3.php":
								echo "person.html";
								break;
							case "user_info.php":
								echo "person.html";
								break;
							case "user_edit.php":
								echo "person.html";
								break;
							case "lesson_info.php":
								echo "class.html";
								break;
							case "lesson_add.php":
								echo "class01-1.html";
								break;
							case "lesson_edit.php":
								echo "";
								break;
							case "class01-2.html":
								echo "";
								break;
							case "lesson_config.php":
								echo "class01-2.html";
								break;
							case "lesson_edit_rule.php":
								echo "class01-2.html";
								break;
							case "lesson_drop.php":
								echo "class01-3.html";
								break;
							case "lesson_students.php":
								echo "class01-4.html";
								break;
							case "works.php":
								echo "class02-1.html";
								break;
							case "work_add.php":
								echo "class02-1-1.html";
								break;
							case "work_edit.php":
								echo "class02-2.html";
								break;
							case "work_version_add.php":
								echo "class02-2.html";
								break;
							case "work_version_edit.php":
								echo "class02-2.html";
								break;
							case "work_edit_rule.php":
								echo "class02-2.html";
								break;
							case "work_drop.php":
								echo "class02-3.html";
								break;
							case "work_news_add.php":
								echo "class03-1.html";
								break;
							case "work_news_edit.php":
								echo "class03-2.html";
								break;
							case "work_news_drop.php":
								echo "class03-3.html";
								break;
							case "work_comments_from_author_list.php":
								echo "comment.html";
								break;
							default:
								echo "person.html";
								break;
						}
						echo "\" target=\"_blank\">操作說明</a> </span>";
					}
					echo "<span> <a href=\"logout.php\">登出帳號</a> </span>";
				} else {
					echo "<span> <a href=\"Documents\student_guideline\pre_register\S-manual.html\" target=\"_blank\">註冊說明</a> </span>";
					echo "<span> <a href=\"user_add.php\">註冊帳號</a> </span>";
					echo "<span> <a href=\"login.php\">登入帳號</a> </span>";
				}
				echo "<span> <a href=\"contact.php\">連絡我們</a> </span>";
			}
			?>
		</td>
	</tr>
	<tr valign="top">
		<td colspan="2"><!-- InstanceBeginEditable name="body" -->
			<table cellspacing="1" class="common_table" style="width: 600px;">
				<tr>
					<th width="80" nowrap="nowrap"><strong>授課學期</strong></th>
					<th nowrap="nowrap"><strong>課程名稱</strong></th>
					<th nowrap="nowrap"><strong>課程狀態</strong></th>
					<th width="65" nowrap="nowrap"><a href="lesson_add.php">新增課程</a></th>
				</tr>
				<?php
				// $last_lesson_status 紀錄上個課程的狀態，依此判斷是否該用粗體線隔開
				$last_lesson_status = $row_RecordsetLessons['lesson_status'];
				$last_lesson_year = $row_RecordsetLessons['lesson_year'];
				$last_lesson_session = $row_RecordsetLessons['lesson_session'];
				?>
				<?php do { ?>
					<?php if ($totalRows_RecordsetLessons > 0) { // Show if recordset not empty ?>
						<?php
						if (($last_lesson_year != $row_RecordsetLessons['lesson_year']) && ($last_lesson_session != $row_RecordsetLessons['lesson_session'])){
							echo "<tr valign=\"top\"><td colspan=\"4\"><hr></td></tr>";
						}
						?>
						<?php
						// $last_lesson_status 紀錄上個課程的狀態，依此判斷是否該用粗體線隔開
						$last_lesson_status = $row_RecordsetLessons['lesson_status'];
						$last_lesson_year = $row_RecordsetLessons['lesson_year'];
						$last_lesson_session = $row_RecordsetLessons['lesson_session'];
						?>
						<tr valign="top">
							<td nowrap="nowrap" style="border-top-width:3px"><?php echo $row_RecordsetLessons['lesson_year']; ?>年第<?php echo $row_RecordsetLessons['lesson_session']; ?>學期<br />
								(<a href="work_news_add.php?lesson_id=<?php echo $row_RecordsetLessons['lesson_id']; ?>&amp;work_id=0">新增消息</a>)</td>
							<td nowrap="nowrap"><a href="works.php?lesson_id=<?php echo $row_RecordsetLessons['lesson_id']; ?>"><?php echo $row_RecordsetLessons['lesson_name_cht']; ?> (<?php echo $row_RecordsetLessons['lesson_name_eng']; ?>)</a><br />
								<table border="0" cellpadding="0" cellspacing="0" style="width:60%;">
									<?php
								$colname_RecordsetNews = $row_RecordsetLessons['lesson_id'];
								$query_RecordsetNews = sprintf("SELECT * FROM pes_news WHERE news_lesson_id = %s ORDER BY news_id DESC", GetSQLValueString($colname_RecordsetNews, "int"));
								$RecordsetNews = mysql_query($query_RecordsetNews, $pes_conn) or die(mysql_error());
								$row_RecordsetNews = mysql_fetch_assoc($RecordsetNews);
								$totalRows_RecordsetNews = mysql_num_rows($RecordsetNews);
								?>
									<?php if ($totalRows_RecordsetNews > 0) { // Show if recordset not empty ?>
										<?php do { ?>
											<tr>
												<td nowrap="nowrap" width="32"> <a href="work_news_edit.php?lesson_id=<?php echo $row_RecordsetLessons['lesson_id']; ?>&amp;work_id=0&amp;news_id=<?php echo $row_RecordsetNews['news_id']; ?>"><img src="images/13x13_Edit.gif" alt="編輯" width="13" height="13" border="0" align="absmiddle" /></a> <a href="work_news_drop.php?lesson_id=<?php echo $row_RecordsetLessons['lesson_id']; ?>&amp;work_id=0&amp;news_id=<?php echo $row_RecordsetNews['news_id']; ?>"><img src="images/13x13_Trashcan.gif" alt="刪除" width="13" height="13" border="0" align="absmiddle" /></a> </td>
												<td> <u><?php echo $row_RecordsetNews['news_name']; ?></u> </td>
											</tr>
											<?php } while ($row_RecordsetNews = mysql_fetch_assoc($RecordsetNews)); ?>
										<?php } // Show if recordset not empty ?>
								</table>
							</td>
							<td nowrap="nowrap">
								<?php
								switch ($row_RecordsetLessons['lesson_status']) {
									case "-1" :
										echo "未開放";
										break;
									case "0" :
										echo "已結束";
										break;
									case "1" :
										echo "開放中";
										break;
								}
								?>
							</td>
							<td nowrap="nowrap"> <a href="lesson_edit.php?lesson_id=<?php echo $row_RecordsetLessons['lesson_id']; ?>"><img src="images/13x13_Edit.gif" alt="編輯" width="13" height="13" border="0" align="absmiddle" /></a> <a href="lesson_drop.php?lesson_id=<?php echo $row_RecordsetLessons['lesson_id']; ?>"><img src="images/13x13_Trashcan.gif" alt="刪除" width="13" height="13" border="0" align="absmiddle" /></a> <a href="lesson_students.php?lesson_id=<?php echo $row_RecordsetLessons['lesson_id']; ?>&amp;sort=user_id"><img src="images/person_16x16.gif" alt="選修名單" width="16" height="16" border="0" align="absmiddle" /></a></td>
						</tr>
						<?php } // Show if recordset not empty ?>
					<?php } while ($row_RecordsetLessons = mysql_fetch_assoc($RecordsetLessons)); ?>
				<tr valign="top">
					<td colspan="4" nowrap="nowrap"><a href="home.<?php echo $_SESSION['MM_UserGroup']; ?>.php"><img src="images/back_15x15.gif" alt="前一頁" width="15" height="15" border="0" align="absmiddle" /> 前一頁</a> </td>
				</tr>
			</table>
			<!-- InstanceEndEditable --></td>
	</tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RecordsetLessons);

mysql_free_result($RecordsetNews);
?>
