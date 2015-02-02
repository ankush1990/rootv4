<?php
require('../connection.php');
//{"username": "abc","password": 123}
$jsondata = $_SERVER['HTTP_JSON'];
$json = json_decode($jsondata);
$username = $json->username;
$password = $json->password;
$result = pg_query("select username from ".'setup.stp$sec_user'." where username = '".$username."' and user_pwd = '".$password."'");
$count = pg_num_rows($result);

if($count > 0)$list['result'] = "Success";
else $list['result'] = "Fail";
echo json_encode($list);

?>