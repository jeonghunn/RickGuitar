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
 
require 'core/db.php';
require 'core/logger.php';
require 'core/security.php';
require 'core/ip_manage.php';
require 'core/permission.php';
require 'core/auth.php';
    
  
?>