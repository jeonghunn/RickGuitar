<?php
require_once '../core/base.php';

$authcode = $_POST['authcode'];
$kind = mysql_real_escape_string($_POST['kind']);
$category = mysql_real_escape_string($_POST['category']);
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$value = mysql_real_escape_string($_POST['value']);
$log = "$value";
$log_category = "$kind";


define('642979',   TRUE);
require '../config.php';


//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

//Change Auth code to tarks account
require '../member/member_class.php';
require 'favorite_class.php';

//for doc, comment etc
if($kind == 1){

}

//favorite_read
if($kind == "favorite_read"){
	$FavoriteList = favorite_read_page($category, $user_srl, $value);
favorite_PrintListbyUpdate($FavoriteList);
}


//favorite_delete
if($kind == "favorite_delete"){
	$favoritedelete = favorite_delete($value, $user_srl, $category);
	if($favoritedelete)
	 { echo "favorite_delete_succeed";} else { echo "favorite_delete_error";}
}



      
?>