<?php require_once('Connections/pes_conn.php'); ?>
<?php
// *** Logout the current user.
$_SESSION['MM_Username'] = NULL;
$_SESSION['MM_UserGroup'] = NULL;
$_SESSION['MM_Realname'] = NULL;
unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);
unset($_SESSION['MM_Realname']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.8" />
<meta http-equiv="refresh" content="0.5; url=index.php"/>
<title>Peer Evaluation System 同儕評量系統</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="inc.script.js"></script>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>

<div style="font-size:50px;">
		掰掰 ！
</div>

</body>
<!-- InstanceEnd --></html>
