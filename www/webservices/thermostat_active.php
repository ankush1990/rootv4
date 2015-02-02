<?php
	require('../connection.php');
	$thermostat_id = $_REQUEST['thermostat_id'];
	$result = pg_query("select ".'master.mtr$active_themostate'."('".$thermostat_id."')");
	if($result){
		if($result)$list['result'] = "Success";
		else $list['result'] = "Fail";
		echo json_encode($list);
	}
?>