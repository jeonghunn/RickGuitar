<?php
$authcode = $_POST['authcode'];
$kind = mysql_real_escape_string($_POST['kind']);
$category = mysql_real_escape_string($_POST['category']);
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$value = mysql_real_escape_string($_POST['value']);
$log = "$value";
$log_category = "favorite_read";


define('642979',   TRUE);
require '../config.php';


//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

//Change Auth code to tarks account
require '../member/member_info_class.php';
require 'favorite_class.php';

//for doc, comment etc
if($kind == 1){

}

//User
if($kind == 2){
	$FavoriteList = favorite_read_page($category, $user_srl_auth, $value);
favorite_PrintListbyUpdate($FavoriteList);
}





      
?>