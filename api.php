<?php

 require_once 'core/base.php';

$API_VERSION = (int) REQUEST('apiv');
$ACTION = REQUEST('a');
$user_srl_auth =POST('user_srl_auth');
$api_key =REQUEST('api_key');

//Log
$log = REQUEST('page_srl');
$log_category = $ACTION;

define('642979',   TRUE);
require_once 'config.php';
require_once 'core/api.class.php';
require_once 'modules/page/page.class.php';
require_once 'modules/member/tarks_account.class.php';

$user_srl = AuthCheck($user_srl_auth, false);

$API = new APIClass();
if($api_key == null) ErrorMessage('api_error');


if($ACTION == "hello_world") $API -> hello_world();
if($ACTION == "CoreVersion") $API -> API_getCoreVersion();
if($ACTION == "my_page_info") $API -> API_getMyPageInfo( $user_srl);

//Page
if($ACTION == "page_info") $API -> API_getPageInfo($user_srl);

//Member
if($ACTION == "tarks_auth") $API -> API_AuthTarksAccount();
if($ACTION == "make_tarks_authcode") $API -> API_MakeTarksAccountAuth();
if($ACTION == "tarks_sign_up") $API -> API_SignUpTarksAccount();




?>