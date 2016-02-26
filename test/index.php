<?php
require_once('../connection/connection.php');
$da=date("Y-m-d H:i:s");
$i=100001;
while($i<999999)
{
	$name="G".$i;
	//echo $name."<br>";
	$SQL="INSERT INTO pes_students(user_id,user_pw,user_name,user_email,create_time) VALUES('$name','$name','$name','guest@g.gal','$da')";
	mysqli_query($pes_conni,$SQL);
	$SQL2="INSERT INTO pes_students_lessons (user_id,lesson_id,user_validated) VALUES('$name','53','1')";
	mysqli_query($pes_conni,$SQL2);
	$i++;
	sleep(0.1);
}

//$SQL="INSERT INTO pes_students(user_id,user_pw,user_name,user_email,create_time) VALUES('a090909','1','testtt','test@g.gal','$da')";
//mysqli_query($pes_conni,$SQL);
//mysqli_close($pes_conni);
/*$SQL2="INSERT INTO pes_students_lessons (user_id,lesson_id,user_validated) VALUES('A1013352','53','1')";
mysqli_query($pes_conni,$SQL2);
mysqli_close($pes_conni);
*/
echo "ok";
?>