<?php if(!defined("642979")) exit();
   
    //ip, url, useragent, date
$siteaddress = "http://tarks.net/favorite/";
$REMOTE_ADDR  = $_SERVER["REMOTE_ADDR"];
$nowurl = $_SERVER["REQUEST_URI"]; 
$useragent = $_SERVER['HTTP_USER_AGENT'];
$date = strtotime(date('Y-m-d H:i:s'));

//Language
$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if($language == null) $language = "en";

// error_reporting(E_ALL);
// ini_set("display_errors", 1);


function ErrorMessage($msg) {
    echo $msg;
    exit();
}

function S($str){
  echo T($str);
}

function P($str){
  echo $str;
}

//Print for native app
function print_info($row, $info){

    for ($i=0 ; $i < count($info);$i++){
   	if(count($info) == $i + 1){
echo $row[$info[$i]];
}else{
	echo $row[$info[$i]]."/LINE/.";
   }

}
    }


//Print for native app
function print_array($row){

   echo implode("/LINE/.", $row);
    }


    function ExplodeInfoValue($info){
	return explode("//",$info);
}

//Language name
function SetUserName($lang, $name_1, $name_2){
if($lang == "ko"){
$name = $name_1.$name_2;
}else{
$name = $name_2." ".$name_1;
}
return $name;
}

function setRelationStatus($me_srl, $you_srl){
//Select you srl
  $me_favorite = mysql_fetch_array(mysql_query("SELECT * FROM  `favorite` WHERE  `user_srl` LIKE '$me_srl' AND `category` LIKE '3' AND `value` LIKE '$you_srl'"));
   $you_favorite = mysql_fetch_array(mysql_query("SELECT * FROM  `favorite` WHERE  `user_srl` LIKE '$you_srl' AND `category` LIKE '3' AND `value` LIKE '$me_srl'"));
  $you_srl_info = mysql_fetch_array(mysql_query("SELECT * FROM  `user` WHERE  `user_srl` LIKE '$you_srl'"));


  //Global
  $status = 0;

  //Member
  if($me_srl != null) $status = 1;

  //Check like me and you are like too.
if($me_favorite[value] == $you_srl) $status = 2;
  //Check like you
if($you_favorite[value] == $me_srl) $status = 3;

  //Check I'm owner
  if($me_srl == $you_srl) $status = 4;
 if($me_srl == $you_srl_info[admin]) $status = 4;
 
 //Check unknown
 if($you_srl_info[status] > $status) $status = -1;
  return $status;
}

function arr_del($list_arr, $del_value) // 배열, 삭제할 값
{
$b = array_search($del_value,$list_arr); 
if($b!==FALSE) unset($list_arr[$b]); 
 return $list_arr;
}




 
require 'core/db.php';
require 'core/logger.php';
require 'core/security.php';
require 'core/ip_manage.php';
require 'core/permission.php';
require 'core/auth.php';


//set user_Srl
$user_srl = AuthCheck($user_srl_auth, false);
//Log Client
ClientAgentLog();
    


  //Set language
if($user_srl != null){
    $user_lang = mysql_fetch_array(mysql_query("SELECT * FROM  `user` WHERE  `user_srl` LIKE '$user_srl'"));
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


?>