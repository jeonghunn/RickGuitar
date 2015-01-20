<?php if(!defined("642979")) exit();
 //add log       
       

function ActLog($user_srl, $REMOTE_ADDR, $date, $log_category, $log){
	   //  mysql_query("INSERT INTO `log` (`user_srl`, `ip_addr`, `date`, `category`, `value`) VALUES ('$user_srl', '$REMOTE_ADDR', '$date' , '$log_category', '$log');");
	echo "lklklklkl";
}

            function ClientAgentLog(){
            	global $user_srl;
            	$row = mysql_fetch_array(mysql_query("SELECT * FROM  `clients` WHERE `ip_addr` LIKE '".getIPAddr()."' AND  `user_agent` LIKE '".getUserAgent()."'"));
            	if($row['ip_addr'] != getIPAddr() || $row['user_agent'] != getUserAgent()){
            	mysql_query("INSERT INTO `clients` (`user_srl`, `ip_addr`, `user_agent`, `date`) VALUES ('$user_srl', '".getIPAddr()."', '".getUserAgent()."' , '".getTimeStamp()."');");
            }
}


function ActLogSyncTask($user_srl, $REMOTE_ADDR, $date, $log_category, $log){
	$thread = new Thread("localhost");
	$thread->setFunc('ActLog', array($user_srl, $REMOTE_ADDR, $date, $log_category, $log));
	$thread->start();
	while ( !$thread->finished){

		$thread->query();
	}
	printf("Thread1: %s <br>", $thread->result);
}


function ClientAgentLogSyncTask(){
	$thread = new Thread("localhost");
	$thread->setFunc('ClientAgentLog', array());
	$thread->start();
}

  
        

?>