<?php
$authcode = $_POST['authcode'];
$fav_user_srl = mysql_real_escape_string($_POST['value']);
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$category = mysql_real_escape_string($_POST['category']);
$log = "$value";
$log_category = "favorite_add";


define('642979',   TRUE);
require '../config.php';


//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

//Change Auth code to tarks account
require '../member/member_class.php';
require '../member/push_class.php';
require 'favorite_class.php';



	$favorite_add = favorite_add($fav_user_srl, $user_srl , $category);
if($favorite_add == true){
	echo "favorite_add_succeed";
	
}else{
echo "favorite_add_error";
}





      
?>