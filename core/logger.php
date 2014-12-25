<?php if(!defined("642979")) exit();
 //add log       
       

function ActLog($user_srl, $REMOTE_ADDR, $date, $log_category, $log){
	     mysql_query("INSERT INTO `log` (`user_srl`, `ip_addr`, `date`, `category`, `value`) VALUES ('$user_srl', '$REMOTE_ADDR', '$date' , '$log_category', '$log');");
}

            function ClientAgentLog(){
            	global $user_srl, $REMOTE_ADDR, $useragent, $date;
            	$row = mysql_fetch_array(mysql_query("SELECT * FROM  `clients` WHERE `ip_addr` LIKE '$REMOTE_ADDR' AND  `user_agent` LIKE '$useragent'"));
            	if($row[ip_addr] != $REMOTE_ADDR || $row[user_agent] != $useragent){
            	mysql_query("INSERT INTO `clients` (`user_srl`, `ip_addr`, `user_agent`, `date`) VALUES ('$user_srl', '$REMOTE_ADDR', '$useragent' , '$date');");
            }

        }



   

?>