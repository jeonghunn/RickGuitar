<?php
require_once '../core/base.php';

//Variable
$authcode = $_POST['authcode'];
$kind = mysql_real_escape_string($_POST['kind']);
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$profile_user_srl = mysql_real_escape_string($_POST['profile_user_srl']);
$name_1 = mysql_real_escape_string($_POST['name_1']);
$name_2 = mysql_real_escape_string($_POST['name_2']);
$lang = mysql_real_escape_string($_POST['lang']);
$profile_pic = mysql_real_escape_string($_POST['profile_pic']);
$category = mysql_real_escape_string($_POST['category']);
$value = mysql_real_escape_string($_POST['value']);



$log = $profile_user_srl;
$log_category = "profile_update";

define('642979',   TRUE);
require '../config.php';

//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

require_once '../core/Thumbnail.class.php';
require 'member_class.php';

//Check user info and auth
//$user_srl = AuthCheck($user_srl_auth, false);
$status = setRelationStatus($user_srl, $profile_user_srl);
if($status < 4) ErrorMessage("permission_error");


//Profile picture
if($kind == 1){
	if($profile_pic == "Y"){
ProfileUpdate($profile_user_srl);
} else {
	ProfileInfoUpdate($profile_user_srl, "profile_pic", "N");
}
}

//Profile name
if($kind == 2 && $name_2 != null){
ProfileInfoUpdate($profile_user_srl, "name_1", $name_1);
ProfileInfoUpdate($profile_user_srl, "name_2", $name_2);
ProfileInfoUpdate($profile_user_srl, "lang", $lang);
}


//Profile name
if($kind == 3){
ProfileInfoUpdate($profile_user_srl, $category, $value);
}



?>