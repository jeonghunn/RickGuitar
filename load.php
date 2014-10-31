<?php

$API_VERSION = (int) $_POST['apiv'];
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$member_info = mysql_real_escape_string($_POST['member_info']);
$log = "$lang";
$log_category = "load_app";

define('642979',   TRUE);
require 'config.php';

//Auth code to user_srl

require 'member/member_class.php';
$user_srl = AuthCheck($user_srl_auth, false);



//Update new member information
    PageInfoUpdate($user_srl);


    
  print_info(GetMemberInfo($user_srl), ExplodeInfoValue($member_info));
?>