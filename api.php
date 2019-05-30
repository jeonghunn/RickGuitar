<?php
define('642979',   TRUE);

require_once 'config.php';
 require_once 'core/base.php';
 require_once 'core/db.php';


//debugMode();

$API_VERSION = (int) REQUEST('apiv');
$ACTION = REQUEST('a');
$page_auth =POST('auth');

//Log
$log = REQUEST('page_srl');
$log_category = $ACTION;

require_once 'core/auth.php';

$user_srl = AuthCheck($page_auth, 'user_srl', false);
(int)$user_permission_status = 3; // User Permission Default
if ($user_srl == null) $user_srl = 0;

require_once 'core/logger.php';
require_once 'core/security.php';
require_once 'core/permission.php';

// Client log

//Check IP
PermissionCheckAct($user_srl);
$ipmanage = IPManageAct(getIPAddr(), getNowUrl(), getTimeStamp());


//Log Client
if ($ipmanage) {
    ActLog($user_srl, getIPAddr(), getTimeStamp(), $log_category, $log);
    ClientAgentLog($user_srl, getIPAddr(), getUserAgent(), getTimeStamp());
}



//Load Core Library
require_once 'core/lib/Thumbnail.class.php';


//Import Loader
require_once 'modules/settings/settings.loader.php';
require_once 'modules/main/main.loader.php';
require_once 'modules/account/account.loader.php';
require_once 'modules/board/board.loader.php';
require_once 'modules/page/page.loader.php';
require_once 'modules/notification/notification.loader.php';
require_once 'modules/attach/attach.loader.php';
require_once 'modules/square/square.loader.php';

require_once 'modules/main/main.api.php';
require_once 'modules/account/account.api.php';
require_once 'modules/board/board.api.php';
require_once 'modules/page/page.api.php';
require_once 'modules/attach/attach.api.php';
require_once 'modules/square/square.api.php';









?>