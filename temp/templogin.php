<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8;"/>
<meta name="viewport" content="width=device-width, initial-scale=0.8" />
<title>試用登入</title>
<style>@media only screen and (-webkit-device-pixel-ratio: 2) {}</style>
<style> 
  .textbox { 
    background: white; 
    border: 1px solid #ffa853; 
    border-radius: 5px; 
    box-shadow: 0 0 5px 3px #ffa853; 
    color: #666; 
    outline: none; 
    height:23px; 
    width: 275px; 
  } 
 </style> 

</head>
<body style='height:60%;'>
<h1 style="text-align:center;">IRS試用系統</h1>
<form action='./logincheck.php' method='post' style='text-align:center;'>
<text style='font-size:200%;'  >請輸入學號</text><br>
<input class="textbox" placeholder='學號' type='text' name='guestname' style='text-align:center;font-size:200%;margin-top:10%;padding:5%;'><br>
<input style='font-size:250%;margin-top:5%;max-width:100%;' type='submit' value='確認'><br>
</form>
<?php 
if($_SESSION['chinex']==1)
{
	echo "<h1 align=center style='color:red;'>學號只能輸入英文及數字喔！<br>字數限制:12字元</h1>";
	$_SESSION['chinex']=0;
}
?>
</body>
</html>

