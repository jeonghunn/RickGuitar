<?
$authcode = $_POST['authcode'];
$id = addslashes($_POST['id']);
$password = addslashes($_POST['password']);
$log = addslashes($id);

define('642979',   TRUE);
require '../db.php';
mysql_select_db('xe',$db_conn);

//Check Auth
if($authcode != $auth) exit(); 
//Protect from sql injection
if(!rtnSpecialCharCheck("$id$password")) exit();


$sql ="SELECT * FROM  `xe_member` WHERE  `user_id` LIKE '$id' AND  `password` LIKE '$password'";
$result = mysql_query($sql);
$row=mysql_fetch_array($result);
 if($id == $row[user_id]){
 	//Reg Auth to server
 	//auth_value is use by auth.php
 	$auth_value = $row[user_id];
require '../auth.php';
//MakeAuth Code
  $auth_code_result = MakeAuthCode($auth_value, "tarks_account");
 	//Echo Auth code to client
//auth_code_result is value of result of auth
echo "$auth_code_result";
}
   
?>