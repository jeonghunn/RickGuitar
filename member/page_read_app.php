<?php
require_once 'pages/base.php';

$authcode = $_POST['authcode'];
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$kind = mysql_real_escape_string($_POST['kind']);
$value = mysql_real_escape_string($_POST['value']);
$start_num = mysql_real_escape_string($_POST['start_num']);
$pages_number = mysql_real_escape_string($_POST['pages_number']);

//Compatability
if($kind == null) $kind = "page_update";

$log = "page_list_read";
$log_category = $kind;


define('642979',   TRUE);
require '../config.php';


//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

//Change Auth code to tarks account
require 'member_class.php';


//compatability
if($start_num == null) $start_num = 0;
if($pages_number == null) $pages_number = 30;

//User by update
if($kind == "page_update"){
	$page_list = GetAllMemberInfoByUpdate($user_srl, $start_num, $pages_number);
member_PrintListbyUpdate($page_list);
}

if($kind == "phone_numbers"){
	$page_list = PhoneNumberToPageNumber(explode("//",$value));
	member_PrintListbyUpdate($page_list);

	if($page_list == false){
		echo "null";
	}
	
}

if($kind == "popularity"){
	$page_list = GetAllMemberInfoByPopularity($user_srl, $start_num, $pages_number);
	member_PrintListbyUpdate($page_list);
}





?>
