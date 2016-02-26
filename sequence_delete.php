<?php session_start() ;?>
<?php require_once("connection/connection.php"); ?>
<?php
$LessonID= $_SESSION['lesson_id'];
$SQL="DELETE FROM irs_ans_sequence WHERE Lesson_ID='$Lesson_ID'";
mysqli_query($irs_conni,$SQL);


?>