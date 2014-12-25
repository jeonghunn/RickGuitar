<?php if(!defined("642979")) exit();
   
    //ip, url, useragent, date
$siteaddress = "http://tarks.net/develop/favorite/";
$REMOTE_ADDR  = $_SERVER["REMOTE_ADDR"];
$nowurl = $_SERVER["REQUEST_URI"]; 
$useragent = $_SERVER['HTTP_USER_AGENT'];
$date = strtotime(date('Y-m-d H:i:s'));
$SERVER_VERSION = "2.15.0.97";

//Language
$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if($language == null) $language = "en";

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

 require 'core/util.php';
require 'core/db.php';
require 'core/auth.php';
if($API_VERSION != 0) include_once("core/thread.class.php");
//require 'core/thread.class.php';

//echo "ITS OK";

$user_srl = AuthCheck($user_srl_auth, false);

<<<<<<< HEAD

require 'core/logger.php';
require 'core/security.php';
require 'core/permission.php';

//Log Client
ActLog($user_srl, $REMOTE_ADDR, $date, $log_category, $log);
ClientAgentLog();

//set user_Srl


    


=======
>>>>>>> a765c313250ddcfa2c535c50f643a1231a8c3a69
  //Set language
if($user_srl != null){
    $user_lang = mysql_fetch_array(mysql_query("SELECT * FROM  `pages` WHERE  `user_srl` LIKE '$user_srl'"));
    $language = $user_lang[lang];
}


    // setup locale and translation
    setlocale(LC_ALL, 'en_US.UTF-8');
 require "lang/".$language.".php";

    function T($str)
    {
        global $L;
        if (isset($L[$str]))
            return $L[$str];
        else
            return $str;
    }


<<<<<<< HEAD
//Check IP
PermissionCheckAct();
IPManageAct();
=======
require 'core/logger.php';
startLogger();
require 'core/security.php';
require 'core/permission.php';

//require 'core/ip_manage.php';
>>>>>>> a765c313250ddcfa2c535c50f643a1231a8c3a69

?>