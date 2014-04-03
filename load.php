<?php

$authcode = $_POST['authcode'];
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$member_info = mysql_real_escape_string($_POST['member_info']);
$log = "$lang";

define('642979',   TRUE);
require 'config.php';

//Check Permission
if($authcode != $auth) ErrorMessage("auth_error");

//Auth code to user_srl

require 'member/member_info_class.php';
$user_srl = AuthCheck($user_srl_auth, false);

//Log Client
ClientAgentLog();

//Update new member information
    MemberInfoUpdate($user_srl);


    
  print_info(GetMemberInfo($user_srl), ExplodeInfoValue($member_info));
?>