<?php 
$x=array();
$a=20;
$b=40;
for($i=0;$i<$a;$i++)
{
	for($j=0;$j<$b;$j++)
	{
	    $aa = pow((20-$j),2);
		$bb = pow((10-$i),2);
		$result=($aa+$bb);
		$result=sqrt($result);
		echo $result."<br>";
		if(($result)<10.00)
		{
			$x[i][j]="*";
		}
	}
}

for($i=0;$i<$a;$i++)
{
	for($j=0;$j<$b;$j++)
	{
		echo $x[i][j];
	}
	print "<br>";
}

?>