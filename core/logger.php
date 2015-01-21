<?php if(!defined("642979")) exit();
 //add log       
       

function ActLog($user_srl, $REMOTE_ADDR, $date, $log_category, $log){
	     mysql_query("INSERT INTO `log` (`user_srl`, `ip_addr`, `date`, `category`, `value`) VALUES ('$user_srl', '$REMOTE_ADDR', '$date' , '$log_category', '$log');");
}

            function ClientAgentLog($user_srl, $REMOTE_ADDR, $useragent, $date){
            	$row = mysql_fetch_array(mysql_query("SELECT * FROM  `clients` WHERE `ip_addr` LIKE '$REMOTE_ADDR' AND  `user_agent` LIKE '$useragent'"));
            	if($row['ip_addr'] != $REMOTE_ADDR || $row['user_agent'] != $useragent){
            	mysql_query("INSERT INTO `clients` (`user_srl`, `ip_addr`, `user_agent`, `date`) VALUES ('$user_srl', '$REMOTE_ADDR', '$useragent' , '$date');");
            }
}


function ActLogSyncTask($user_srl, $REMOTE_ADDR, $date, $log_category, $log){
	//require_once 'core/thread.class.php';
	$thread = new Thread("localhost");
	$thread->setFunc('ActLog', array($user_srl, $REMOTE_ADDR, $date, $log_category, $log));
	$thread->start();

}


function ClientAgentLogSyncTask($user_srl){
	//require_once 'core/thread.class.php';
	$thread = new Thread("localhost");
	$thread->setFunc('ClientAgentLog', array($user_srl, getIPAddr(), getUserAgent(), getTimeStamp()));
	$thread->start();
}

  
        

?>