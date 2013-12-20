<?php if(!defined("642979")) exit();
    $db_conn = mysql_connect('localhost','root','tarksmysql?!?!?!');
    $auth = "642979";

    //ip
$REMOTE_ADDR  = $_SERVER["REMOTE_ADDR"];
//url
$nowurl = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; 
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


//UTF-8
mysql_query("set session character_set_connection=utf8;");
    mysql_query("set session character_set_results=utf8;");
    mysql_query("set session character_set_client=utf8;");


//Example Code of protect SQL injection
//if(!rtnSpecialCharCheck($value_1)) exit();


//logger
mysql_select_db('favorite',$db_conn);
  //add log       
            mysql_query("INSERT INTO `log` (`user_srl`, `ip_addr`, `date`, `url`, `value`) VALUES ('$user_srl', '$REMOTE_ADDR', '$date' , '$nowurl', '$log');");

          //  Permission Check
        $sql ="SELECT * FROM  `user` WHERE  `user_srl` LIKE '$user_srl'";
        $result = mysql_query($sql);
        $row=mysql_fetch_array($result);

        if($row[permission] > $permission_allow && $permission_allow != 0) {
        	echo "permission_error";
        	exit();
        }

  
?>