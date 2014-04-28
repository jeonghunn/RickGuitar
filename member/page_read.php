<?php
$authcode = $_POST['authcode'];
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$log = "page_list_read";
$log_category = "page_read";


define('642979',   TRUE);
require '../config.php';


//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

//Change Auth code to tarks account
require 'member_class.php';



//User

	$page_list = GetAllMemberInfoByUpdate($user_srl_auth, 0, 30);
member_PrintListbyUpdate($page_list);



?>
