<?php

$API_VERSION = (int) $_REQUEST['apiv'];
$ACTION = $_REQUEST['a'];
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);

//Log
$log = mysql_real_escape_string($_REQUEST['page_srl']);
$log_category = $ACTION;

define('642979',   TRUE);
require 'config.php';
require 'member/member_class.php';
require 'core/api.class.php';

$user_srl = AuthCheck($user_srl_auth, false);

$API = new APIClass;


if($ACTION == "hello_world") $API -> hello_world(); 
if($ACTION == "load_app") $API -> API_load_app($user_srl); 

//Page
if($ACTION == "page_info") $API -> API_getPageInfo($user_srl);

//Member
if($ACTION == "tarks_sign_up") $API -> API_SignUpTarksAccount();




?>