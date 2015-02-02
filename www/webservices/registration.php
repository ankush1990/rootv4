<?php
require('../connection.php');
//{"username": "abc","password": 123,"thermostatid": 123,"location": "New York","floorname": "Floor1","department": "Dept1","email":"example@gmail.com","companyname":"Magnum","phone":9658712345,"loc_org_id": 1}
	$jsondata = $_SERVER['HTTP_JSON'];
	$jsonobj = json_decode($jsondata);
	
	$thermostatid = $jsonobj->thermostatid;
	$location = $jsonobj->location;
	$floor = $jsonobj->floorname;
	$department = $jsonobj->department;
	$username = $jsonobj->username;
	$password = $jsonobj->password;
	$email = $jsonobj->email;
	$companyname = $jsonobj->companyname;
	$contactnumber = $jsonobj->phone;
	$loc_orgid = $jsonobj->loc_org_id;
	$usertype = "A";
	//================================Insert User into the userinfo table================================================= 
	
	$userid_result = pg_query("select ".'setup.stp$id_gen'."(1, 1,'U')");
	$userid_row = pg_fetch_array($userid_result);
	
	$org_result = pg_query("select ".'setup.stp$id_gen'."(1, 1,'O')");
	$org_row = pg_fetch_array($org_result);
	
	$result = pg_query("INSERT INTO ".'setup.stp$sec_user'."(sloc_id,org_id,loc_org_id,user_id,username,user_pwd, user_resv, user_actve,create_dt, uml_email_id,user_phone, user_type) 
	VALUES (1,'".$org_row['stp$id_gen']."','".$loc_orgid."','".$userid_row['stp$id_gen']."','".$username."','".$password."','Y','Y','".date("Y-m-d")."','".$email."','".$contactnumber."','".$usertype."')");
	
	$result1 = pg_query("INSERT INTO ".'setup.stp$org'."(sloc_id,org_id,loc_org_id,org_desc,username,thermostat_id,password,org_active,create_dt) 
	VALUES (1,'".$org_row['stp$id_gen']."','".$loc_orgid."','".$companyname."','".$username."','".$thermostatid."','".$password."','Y','".date("Y-m-d")."')");
	
	
	pg_query("delete from ".'integrate.int$valid_thermostat'." where thermostat_id = '".$thermostatid."'");
	
	if($result)$list['result'] = "Success";
	else $list['result'] = "Fail";
	echo json_encode($list);


?>