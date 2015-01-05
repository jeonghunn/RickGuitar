<?php

 require_once 'core/base.php';

$API_VERSION = (int) REQUEST('apiv');
$ACTION = REQUEST('a');
$user_srl_auth =POST('user_srl_auth');

//Log
$log = REQUEST('page_srl');
$log_category = $ACTION;

define('642979',   TRUE);
require_once 'config.php';
require_once 'core/api.class.php';
require_once 'modules/page/page.class.php';

$user_srl = AuthCheck($user_srl_auth, false);

$API = new APIClass;


if($ACTION == "hello_world") $API -> hello_world();
if($ACTION == "CoreVersion") $API -> API_getCoreVersion();
if($ACTION == "load_app") $API -> API_load_app($user_srl); 

//Page
if($ACTION == "page_info") $API -> API_getPageInfo($user_srl);

//Member
if($ACTION == "login") $API -> API_LoginTarksAccount();
if($ACTION == "tarks_sign_up") $API -> API_SignUpTarksAccount();




?>