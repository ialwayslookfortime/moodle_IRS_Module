<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8;"/>
<title></title>
<!-- 引入 jQuery(非必要,去掉時有些寫法要改為javascript) -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<!-- 引入AJAX(必要) -->
<script type="text/javascript" src="student_online.js"></script> 
<script type="text/javascript">
test_ajax('')
</script>
<link rel="stylesheet" type="text/css" href="timetochange_main.css">
</head>
<body>
<!--<div>以ajax實現頁面不刷新,從前端將值傳送到後端處理,並且回傳給前端顯示</div>-->
<!--<input type="text" id="test" value=""/>-->
<div  id="show_area"></div>
<?php 
require_once('../config.php');
require_once('../newconfig.php');
require_once($CFG->dirroot.'../mod/resource/locallib.php');
$id  = optional_param('id', 0, PARAM_INT); //courseid
$examno  = optional_param('examno', 0, PARAM_INT); //examno
?>
</body>
<script type="text/javascript">

test_ajax('<?php echo $id;?>','<?php echo $examno;?>');
</script>
</html>
