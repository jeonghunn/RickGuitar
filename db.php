<?php if(!defined("642979")) exit();
    $db_conn = mysql_connect('localhost','root','tarksmysql?!?!?!');
    $auth = "642979";

    //ip
$REMOTE_ADDR  = $_SERVER["REMOTE_ADDR"];
//url
//$nowurl = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; 
$nowurl = $_SERVER["REQUEST_URI"]; 
//user agent
$useragent = $_SERVER['HTTP_USER_AGENT'];
//today/time
$date = strtotime(date('Y-m-d H:i:s'));


//Char check
function rtnSpecialCharCheck($str)
{
 if(preg_match("/[#\&\\+\-%@=\/\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $str,  $match))
 {
  return false;
 }
 return true;
}

//Default Settings
$default_permission = "3";


//UTF-8
mysql_query("set session character_set_connection=utf8;");
    mysql_query("set session character_set_results=utf8;");
    mysql_query("set session character_set_client=utf8;");


//Example Code of protect SQL injection
//if(!rtnSpecialCharCheck($value_1)) exit();


//Connect to db
mysql_select_db('favorite',$db_conn) or ErrorMessage("db_error");
//Check Error
// if (mysqli_connect_error()){
//     echo "mysql_connect_error";
//     exit();
// }
function ErrorMessage($msg) {
    echo $msg;
    exit();
}
  //add log       
            mysql_query("INSERT INTO `log` (`user_srl`, `ip_addr`, `date`, `url`, `value`) VALUES ('$user_srl', '$REMOTE_ADDR', '$date' , '$nowurl', '$log');");

     
require 'core/security.php';
require 'core/ip_manage.php';
require 'core/permission.php';

     //  Permission Check
 $permission = mysql_fetch_array(mysql_query("SELECT * FROM  `user` WHERE  `user_srl` LIKE '$user_srl'"));
//Permission Check
        if($permission_allow == null) $permission_allow = 3;
        if($permission[permission] > $permission_allow) ErrorMessage("permission_error");
  
?>