<?php
require('../connection.php');
if(isset($_REQUEST['thermostat_id'])){	
	$list = array();
	$result = pg_query("insert into ".'integrate.int$valid_thermostat'." values(DEFAULT,'".$_REQUEST['thermostat_id']."')");
	if($result)$list['result'] = "Success";
	else $list['result'] = "Fail";
	echo json_encode($list);
}
?>