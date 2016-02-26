<?php
	//  Display the course home page.
	//session_start();
	require_once('../config.php');
	require_once('../newconfig.php');
	require_once($CFG->dirroot.'../mod/resource/locallib.php');
	

    $catid       = optional_param('catid', 0, PARAM_INT);
    $uid         = optional_param('uid', 0, PARAM_INT);
    $id   		 = optional_param('id', 0, PARAM_INT); //courseid
    $name        = optional_param('name', '', PARAM_RAW);

    $params = array();
    if (!empty($name)) {
        $params = array('shortname' => $name);
    } else if (!empty($idnumber)) {
        $params = array('idnumber' => $idnumber);
    } else if (!empty($id)) {
        $params = array('id' => $id);
    }else {
        print_error('unspecifycourseid', 'error');
    }

    $userid=$USER->id;
	//echo $userid;
	//$_SESSION['lesson_id']=2;
	//print_r($USER->id);
	/*$FindAllResource="SELECT name,revision FROM mdl_resource WHERE course='$id'";
	$FindAllResourceQuery=mysqli_query($newconni,$FindAllResource);
	
		//$filename = $file->get_filename();
    	$path = '/'.$file->get_contextid().'/mod_resource/content/'.$revision.$file->get_filepath().$file->get_filename();
    	$fullurl = file_encode_url($CFG->wwwroot.'/pluginfile.php', $path, true);
		
		$FindRate="SELECT count(id) as allview FROM mdl_logstore_standard_log WHERE courseid='$id' AND contextinstanceid='$resourceid' AND action='viewed'";
		$FindQuery=mysqli_query($newconni,$FindRate);
		foreach($FindQuery as $value)
		{
			$allviewnum=$value['allview'];
			//echo $value['allview'];
		}
*/
?>
<!DOCTYPE html>
<html lang="en">
	<head>		
		<meta charset="UTF-8">
		<title>IRS</title>
		<link rel="stylesheet" href="abc.css">
	</head>
	<body>
	<?php 
	echo "pokok";
	$sql="SELECT ra.roleid as roid FROM mdl_role_assignments ra WHERE ra.userid ='$userid' AND ra.contextid IN (SELECT ctx.id FROM mdl_context ctx WHERE ctx.instanceid = '$id')";
	$query=mysqli_query($newconni,$sql);
	
	foreach($query as $value)
	{
		//echo "111";
		$group=$value['roid'];
		//echo $value['roid'];
	}
	
		if($group==3 || $group==4)
		{
			header("Location: index_teacher.php?id=".$id);
			
		}
		else
		{
			header("Location: index_student.php?id=".$id);
		}
	
	?>
	</body>
</html>
