<?php if(!defined("642979")) exit();
   
    //ip, url, useragent, date
$REMOTE_ADDR  = $_SERVER["REMOTE_ADDR"];
$nowurl = $_SERVER["REQUEST_URI"]; 
$useragent = $_SERVER['HTTP_USER_AGENT'];
$date = strtotime(date('Y-m-d H:i:s'));


function ErrorMessage($msg) {
    echo $msg;
    exit();
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
  $you_srl_info = mysql_fetch_array(mysql_query("SELECT * FROM  `user` WHERE  `user_srl` LIKE '$you_srl'"));

  //Global
  $status = 0;

  //Check like me and you are like too.

  //Check like me

  //Check I'm owner
  if($me_srl == $you_srl) $status = 4;
 if($me_srl == $you_srl_info[admin]) $status = 4;
  return $status;
}
 
require 'core/db.php';
require 'core/logger.php';
require 'core/security.php';
require 'core/ip_manage.php';
require 'core/permission.php';
require 'core/auth.php';
    
  
?>