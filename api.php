<?php

$API_VERSION = (int) $_REQUEST['apiv'];
$ACTION = $_REQUEST['a'];
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);

define('642979',   TRUE);
require 'config.php';
require 'member/member_class.php';
require 'core/api_class.php';

$user_srl = AuthCheck($user_srl_auth, false);

$API = new APIClass;


if($ACTION == "hello_world") $API -> hello_world(); 
if($ACTION == "load_app") $API -> load_app($user_srl); 

//Page
if($ACTION == "page_info") $API -> getPageInfo($user_srl);





?>