<?php if(!defined("642979")) exit();
   
    //ip, url, useragent, date
//$siteaddress = "http://tarks.net/develop/favorite/";
//$REMOTE_ADDR  = $_SERVER["REMOTE_ADDR"];
//$nowurl = $_SERVER["REQUEST_URI"];
//$useragent = $_SERVER['HTTP_USER_AGENT'];
//$date = strtotime(date('Y-m-d H:i:s'));
//$CORE_VERSION = "2.34.5.125";

//Language
//$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
//if($language == null) $language = "en";

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

//db.php

require_once 'core/auth.php';


$user_srl = AuthCheck($page_auth, false);


require_once 'core/logger.php';
require_once 'core/security.php';
require_once 'core/permission.php';
//Log Client
ActLogSyncTask($user_srl, getIPAddr(),getTimeStamp(), $log_category, $log);
ClientAgentLogSyncTask($user_srl);

//set user_Srl


    


//  //Set language
//$language = getHttpLanguage();
//if($user_srl != null){
//    $user_lang = mysql_fetch_array(mysql_query("SELECT * FROM  `pages` WHERE  `user_srl` LIKE '$user_srl'"));
//    $language = $user_lang['lang'];
//}
//
//
//    // setup locale and translation
//    setlocale(LC_ALL, 'en_US.UTF-8');
// require_once "lang/".$language.".php";
//
//    function T($str)
//    {
//        global $L;
//        if (isset($L[$str]))
//            return $L[$str];
//        else
//            return $str;
//    }


//Check IP
PermissionCheckAct($user_srl);
IPManageAct(getIPAddr(), getNowUrl(), getTimeStamp());

?>