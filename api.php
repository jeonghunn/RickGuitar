<?php
define('642979',   TRUE);


 require_once 'core/base.php';
 require_once 'core/db.php';


debugMode();

$API_VERSION = (int) REQUEST('apiv');
$ACTION = REQUEST('a');
$page_auth =POST('auth');
//$api_key =REQUEST('api_key');

//Log
$log = REQUEST('page_srl');
$log_category = $ACTION;


//configure, Load Core System
require_once 'config.php';
//Load Core Library
require_once 'core/lib/Thumbnail.class.php';

//Load Modules.
require_once 'modules/main/main.php';
require_once 'modules/account/account.php';
require_once 'modules/board/board.php';
require_once 'modules/page/page.php';
//loadModule('main');
//loadModule('account');
//loadModule('board');
//loadModule('page');












?>