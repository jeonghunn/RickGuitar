<?php if(!defined("642979")) exit();
   
    //ip, url, useragent, date
$siteaddress = "http://tarks.net/develop/favorite/";
$REMOTE_ADDR  = $_SERVER["REMOTE_ADDR"];
$nowurl = $_SERVER["REQUEST_URI"]; 
$useragent = $_SERVER['HTTP_USER_AGENT'];
$date = strtotime(date('Y-m-d H:i:s'));
$SERVER_VERSION = "2.12.2.93";

//Language
$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if($language == null) $language = "en";

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

 require 'core/util.php';
require 'core/db.php';
require 'core/auth.php';


$user_srl = AuthCheck($user_srl_auth, false);


require 'core/logger.php';
require 'core/security.php';


//Log Client
ClientAgentLog();

//set user_Srl


    


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

require 'core/permission.php';
require 'core/ip_manage.php';

?>